<!-- <template>
    <router-view v-slot="{ Component, route }">
        <div :key="route.name">
            <Component :is="Component" />
        </div>
    </router-view>
</template> -->

<template>
    <router-view :key="$route.fullPath" />
</template>