import { createRouter, createWebHistory } from "vue-router";

const routes = [
    {
        path: "/",
        component: () => import("./Pages/login.vue"),
    },
    {
        path: "/home",
        component: () => import("./Pages/HomeRoute.vue"),
    },
    {
        path: "/edit/account/:encodedId",  // Accept the encoded ID
        name: 'editAccount',
        component: () => import("./Pages/EditAccToName.vue"),
        props: true, 
    },
    {
        path: "/test1",
        component: () => import("./Pages/TestRoute2.vue"),
    },
    {
        path: "/:catchAll(.*)",  // Vue Router 4 syntax for a wildcard route
        name: "NotFound",
        component: () => import("./Pages/NotFound.vue"),
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

// Navigation guard to check for the access token
router.beforeEach((to, from, next) => {
    const token = localStorage.getItem('access_token');
    if (token && to.path === '/') {
        next('/home');
    } else if (!token && to.path !== '/') {
        // If no token exists and trying to access a protected route, redirect to login
        next('/');
    } else {
        // Otherwise, allow navigation
        next();
    }
});

export default router;