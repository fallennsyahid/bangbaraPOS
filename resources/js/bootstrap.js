// import axios from "axios";
// import Echo from "laravel-echo";
// import Pusher from "pusher-js";
// window.axios = axios;
// window.Pusher = Pusher;

// window.Echo = new Echo({
//     broadcaster: "pusher",
//     key: import.meta.env.VITE_PUSHER_APP_KEY,
//     cluster: import.meta.env.VITE_PUSHER_APP_CLUSTER,
//     forceTLS: true,
// });

// window.Echo.channel("orders-status").listen("new-status", (e) => {
//     document.querySelector("#pending-count").innerHTML =
//         e.statusCounts.pending ?? 0;
//     document.querySelector("#processed-count").innerHTML =
//         e.statusCounts.processed ?? 0;
//     document.querySelector("#completed-count").innerHTML =
//         e.statusCounts.completed ?? 0;
//     document.querySelector("#canceled-count").innerHTML =
//         e.statusCounts.canceled ?? 0;
// });

// window.axios.defaults.headers.common["X-Requested-With"] = "XMLHttpRequest";
