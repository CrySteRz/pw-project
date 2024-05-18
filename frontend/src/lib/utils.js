const BASE_URL = "http://localhost:8081";
async function fetchWithAuth(url, options = {}) {
  let token = getCookie("jwt");
  options.headers = options.headers || {};
  options.headers["Authorization"] = `Bearer ${token}`;
  const response = await fetch(`${BASE_URL}${url}`, options);
  if (response.status === 401) {
    document.cookie = "jwt=; Max-Age=0; path=/";
    window.location.href = "/login";
  }
  return response;
}

function getCookie(name) {
  let cookieValue = null;
  if (document.cookie && document.cookie !== "") {
    const cookies = document.cookie.split(";");
    for (let i = 0; i < cookies.length; i++) {
      const cookie = cookies[i].trim();
      if (cookie.substring(0, name.length + 1) === name + "=") {
        cookieValue = decodeURIComponent(cookie.substring(name.length + 1));
        break;
      }
    }
  }
  return cookieValue;
}

function checkJwt(role) {
  const token = getCookie("jwt");
  if (!token) {
    redirectToLogin();
    return false;
  }
  try {
    const payload = JSON.parse(atob(token.split(".")[1]));
    const isExpired = payload.exp < Date.now() / 1000;
    if (isExpired || payload.role !== role) {
      redirectToLogin();
      return false;
    }
  } catch (error) {
    console.error("Error decoding JWT", error);
    redirectToLogin();
    return false;
  }
  return true;
}

//parse token and return data object
function jwtData(token) {
  try {
    return JSON.parse(atob(token.split(".")[1]));
  } catch (e) {
    return null;
  }
}

function redirectToLogin() {
  document.cookie = "jwt=; Max-Age=0; path=/"; // Clear the JWT cookie
  window.location.href = "/login"; // Redirect to login
}

export { fetchWithAuth, getCookie, checkJwt };
