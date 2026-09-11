// Hide runtime JS errors
window.onerror = function () {
    return true;
};

// Hide resource load errors
window.addEventListener("error", function (e) {
    e.preventDefault();
    e.stopImmediatePropagation();
    return true;
}, true);

// Hide promise rejection errors
window.addEventListener("unhandledrejection", function (e) {
    e.preventDefault();
    return true;
}, true);

// Disable all console messages
console.error = function(){};
console.warn  = function(){};
console.log   = function(){};
console.info  = function(){};
console.debug = function(){};
