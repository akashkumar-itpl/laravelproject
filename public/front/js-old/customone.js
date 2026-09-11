
window.onerror = function () {
    return true;    // prevents the red error in console
};

window.addEventListener("error", function (e) {
    e.preventDefault();
    e.stopImmediatePropagation();
    return true;
}, true);

window.addEventListener("unhandledrejection", function (e) {
    e.preventDefault();
    return true;
}, true);

console.error = function () {};

