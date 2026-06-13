const fs = require('fs');
const jsdom = require('jsdom');
const { JSDOM } = jsdom;

const html = fs.readFileSync('app/views/kalender.php', 'utf-8');

const dom = new JSDOM(html, {
  runScripts: "dangerously",
  resources: "usable"
});

try {
  const scriptContent = fs.readFileSync('js/kalender.js', 'utf-8');
  
  // Mock localStorage
  dom.window.localStorage = {
      getItem: function() { return null; },
      setItem: function() {}
  };

  const scriptEl = dom.window.document.createElement('script');
  scriptEl.textContent = scriptContent;
  dom.window.document.body.appendChild(scriptEl);

  console.log("Script executed without top-level errors.");
} catch (e) {
  console.error("Error executing script:", e);
}
