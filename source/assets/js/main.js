if ('loading' in HTMLImageElement.prototype) {
  // Use native lazy loading...
  console.log('lazy load')
}else{
  console.log('polyfill')
  // Load a lazy loading polyfill...
  let script = document.createElement("script");
  script.async = true;
  script.src = "https://cdn.jsdelivr.net/npm/loading-attribute-polyfill@0.2.0/loading-attribute-polyfill.min.js";
  window.document.body.appendChild(script);
}
