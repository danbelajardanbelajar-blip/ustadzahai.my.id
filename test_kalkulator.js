const fs = require('fs');
const jsdom = require('jsdom');
const { JSDOM } = jsdom;

const html = fs.readFileSync('app/views/kalkulator.php', 'utf-8');

const dom = new JSDOM(html, {
  runScripts: "dangerously",
  resources: "usable"
});

try {
  const scriptContent = fs.readFileSync('js/kalkulator.js', 'utf-8');
  
  // Create a mock fetch for updateMinHaid
  dom.window.fetch = function(url) {
      console.log("Fetch called with URL:", url);
      return Promise.resolve({
          json: () => Promise.resolve({
              lahirMasehi: "mock",
              lahirHijriah: "mock",
              minHaidMasehi: "mock",
              minHaidHijriah: "mock"
          })
      });
  };

  dom.window.alert = function(msg) {
      console.log("Alert called with:", msg);
  };

  const scriptEl = dom.window.document.createElement('script');
  scriptEl.textContent = scriptContent;
  dom.window.document.body.appendChild(scriptEl);

  console.log("Script executed without top-level errors.");
} catch (e) {
  console.error("Error executing script:", e);
}
