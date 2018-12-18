export function clearURL() {
  window.history.replaceState(null, null, window.location.pathname);
}