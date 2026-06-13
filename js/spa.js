// SPA Logic for Ustadzah AI

if (!window.spaInitialized) {
    window.spaInitialized = true;

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
        
        // Sync Head Tags (link, style, script) to prevent CSS leaking
        const currentHeadTags = Array.from(document.head.querySelectorAll('link[rel="stylesheet"], style, script[src]'));
        const newHeadTags = Array.from(doc.head.querySelectorAll('link[rel="stylesheet"], style, script[src]'));
        
        // Remove old tags
        currentHeadTags.forEach(currentTag => {
            let existsInNew = false;
            if (currentTag.tagName === 'LINK') {
                existsInNew = newHeadTags.some(t => t.tagName === 'LINK' && t.href === currentTag.href);
            } else if (currentTag.tagName === 'STYLE') {
                existsInNew = newHeadTags.some(t => t.tagName === 'STYLE' && t.innerHTML === currentTag.innerHTML);
            } else if (currentTag.tagName === 'SCRIPT') {
                existsInNew = newHeadTags.some(t => t.tagName === 'SCRIPT' && t.src === currentTag.src);
            }
            if (!existsInNew) {
                currentTag.remove();
            }
        });

        // Add new tags
        newHeadTags.forEach(newTag => {
            let existsInCurrent = false;
            if (newTag.tagName === 'LINK') {
                existsInCurrent = currentHeadTags.some(t => t.tagName === 'LINK' && t.href === newTag.href);
            } else if (newTag.tagName === 'STYLE') {
                existsInCurrent = currentHeadTags.some(t => t.tagName === 'STYLE' && t.innerHTML === newTag.innerHTML);
            } else if (newTag.tagName === 'SCRIPT') {
                existsInCurrent = currentHeadTags.some(t => t.tagName === 'SCRIPT' && t.src === newTag.src);
            }
            if (!existsInCurrent) {
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

        // Sync Head Tags for submit
        const currentHeadTags = Array.from(document.head.querySelectorAll('link[rel="stylesheet"], style, script[src]'));
        const newHeadTags = Array.from(doc.head.querySelectorAll('link[rel="stylesheet"], style, script[src]'));
        
        currentHeadTags.forEach(currentTag => {
            let existsInNew = false;
            if (currentTag.tagName === 'LINK') {
                existsInNew = newHeadTags.some(t => t.tagName === 'LINK' && t.href === currentTag.href);
            } else if (currentTag.tagName === 'STYLE') {
                existsInNew = newHeadTags.some(t => t.tagName === 'STYLE' && t.innerHTML === currentTag.innerHTML);
            } else if (currentTag.tagName === 'SCRIPT') {
                existsInNew = newHeadTags.some(t => t.tagName === 'SCRIPT' && t.src === currentTag.src);
            }
            if (!existsInNew) currentTag.remove();
        });

        newHeadTags.forEach(newTag => {
            let existsInCurrent = false;
            if (newTag.tagName === 'LINK') {
                existsInCurrent = currentHeadTags.some(t => t.tagName === 'LINK' && t.href === newTag.href);
            } else if (newTag.tagName === 'STYLE') {
                existsInCurrent = currentHeadTags.some(t => t.tagName === 'STYLE' && t.innerHTML === newTag.innerHTML);
            } else if (newTag.tagName === 'SCRIPT') {
                existsInCurrent = currentHeadTags.some(t => t.tagName === 'SCRIPT' && t.src === newTag.src);
            }
            if (!existsInCurrent) {
                const clone = document.createElement(newTag.tagName);
                Array.from(newTag.attributes).forEach(attr => clone.setAttribute(attr.name, attr.value));
                if (newTag.innerHTML) clone.innerHTML = newTag.innerHTML;
                document.head.appendChild(clone);
            }
        });

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
}
