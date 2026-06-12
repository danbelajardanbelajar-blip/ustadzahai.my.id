// SPA Logic for Ustadzah AI

document.addEventListener('click', function(e) {
    const a = e.target.closest('a');
    if (!a || !a.href) return;
    
    const url = new URL(a.href, window.location.href);
    
    // Skip if external link, opens in new tab, or just a hash
    if (url.origin !== window.location.origin) return;
    if (a.getAttribute('target') === '_blank') return;
    if (a.getAttribute('href').startsWith('#') || a.getAttribute('href') === 'javascript:void(0)') return;
    if (a.hasAttribute('download')) return;

    e.preventDefault();
    navigateTo(url.href);
});

window.addEventListener('popstate', function(e) {
    navigateTo(window.location.href, false);
});

async function navigateTo(url, pushState = true) {
    // Show a progress bar
    let progress = document.getElementById('spa-progress');
    if (!progress) {
        progress = document.createElement('div');
        progress.id = 'spa-progress';
        progress.style.cssText = 'position:fixed;top:0;left:0;height:3px;background:#fb5c82;width:10%;z-index:9999;transition:width 0.3s;';
        document.body.appendChild(progress);
    }
    
    setTimeout(() => { progress.style.width = '40%'; }, 50);

    try {
        const response = await fetch(url, { headers: { 'X-SPA': 'true' } });
        if (!response.ok) throw new Error('Network response was not ok');
        const html = await response.text();
        
        progress.style.width = '80%';

        const parser = new DOMParser();
        const doc = parser.parseFromString(html, 'text/html');
        
        // Replace Title
        document.title = doc.title;
        
        // Bring in any missing CSS/Styles from the new page's <head>
        Array.from(doc.head.querySelectorAll('link[rel="stylesheet"], style, script[src]')).forEach(newTag => {
            let exists = false;
            if (newTag.tagName === 'LINK') {
                exists = document.head.querySelector(`link[href="${newTag.getAttribute('href')}"]`);
            } else if (newTag.tagName === 'STYLE') {
                exists = Array.from(document.head.querySelectorAll('style')).some(s => s.innerHTML === newTag.innerHTML);
            } else if (newTag.tagName === 'SCRIPT') {
                exists = document.head.querySelector(`script[src="${newTag.getAttribute('src')}"]`);
            }
            if (!exists) {
                const clone = document.createElement(newTag.tagName);
                Array.from(newTag.attributes).forEach(attr => clone.setAttribute(attr.name, attr.value));
                if (newTag.innerHTML) clone.innerHTML = newTag.innerHTML;
                document.head.appendChild(clone);
            }
        });

        // Replace Body Content
        document.body.innerHTML = doc.body.innerHTML;
        document.body.className = doc.body.className; // sync body classes

        // Manually execute scripts found in the new body
        const scripts = document.body.querySelectorAll('script');
        scripts.forEach(oldScript => {
            const newScript = document.createElement('script');
            Array.from(oldScript.attributes).forEach(attr => newScript.setAttribute(attr.name, attr.value));
            if (oldScript.innerHTML) {
                newScript.appendChild(document.createTextNode(oldScript.innerHTML));
            }
            oldScript.parentNode.replaceChild(newScript, oldScript);
        });

        progress.style.width = '100%';
        
        if (pushState) {
            window.history.pushState({}, '', url);
        }
        
        window.scrollTo(0, 0);

        setTimeout(() => progress.remove(), 300);

    } catch (err) {
        console.error('SPA Error:', err);
        // Fallback to full reload if fetching fails
        window.location.href = url;
    }
}

// Intercept form submissions
document.addEventListener('submit', async function(e) {
    const form = e.target;
    
    // Skip if form says no SPA or opens a new tab
    if (form.hasAttribute('data-no-spa') || form.getAttribute('target')) return;
    
    // specifically target login forms or generic posts if they don't have their own fetch handlers
    // If the form has an id like form-undang-submit, it already handles fetch, so skip it
    if (form.id === 'form-undang-submit') return;
    if (form.id === 'dynamicForm') return; // from dashboard
    
    e.preventDefault();
    
    const formData = new FormData(form);
    const url = form.getAttribute('action') || window.location.href;
    const method = (form.getAttribute('method') || 'GET').toUpperCase();
    
    let progress = document.getElementById('spa-progress');
    if (!progress) {
        progress = document.createElement('div');
        progress.id = 'spa-progress';
        progress.style.cssText = 'position:fixed;top:0;left:0;height:3px;background:#fb5c82;width:10%;z-index:9999;transition:width 0.3s;';
        document.body.appendChild(progress);
    }
    
    try {
        let fetchUrl = url;
        let options = { method: method, headers: { 'X-SPA': 'true' } };
        
        if (method === 'POST') {
            options.body = formData;
        } else {
            const params = new URLSearchParams(formData).toString();
            fetchUrl = fetchUrl.includes('?') ? `${fetchUrl}&${params}` : `${fetchUrl}?${params}`;
        }
        
        const response = await fetch(fetchUrl, options);
        progress.style.width = '70%';
        
        const html = await response.text();
        
        const parser = new DOMParser();
        const doc = parser.parseFromString(html, 'text/html');
        
        document.title = doc.title;
        document.body.innerHTML = doc.body.innerHTML;
        document.body.className = doc.body.className;
        
        const scripts = document.body.querySelectorAll('script');
        scripts.forEach(oldScript => {
            const newScript = document.createElement('script');
            Array.from(oldScript.attributes).forEach(attr => newScript.setAttribute(attr.name, attr.value));
            if (oldScript.innerHTML) {
                newScript.appendChild(document.createTextNode(oldScript.innerHTML));
            }
            oldScript.parentNode.replaceChild(newScript, oldScript);
        });
        
        if (response.redirected) {
            window.history.pushState({}, '', response.url);
        } else {
            // Push current URL state if no redirect
            window.history.pushState({}, '', fetchUrl);
        }

    } catch (err) {
        console.error('SPA Submit Error:', err);
        form.submit();
    } finally {
        progress.style.width = '100%';
        setTimeout(() => progress.remove(), 300);
    }
});
