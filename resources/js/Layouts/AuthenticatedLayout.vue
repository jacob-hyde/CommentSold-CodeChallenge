<script setup>
import { ref, watch } from 'vue';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import NavLink from '@/Components/NavLink.vue';
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';
import { Link } from '@inertiajs/vue3';

const showingNavigationDropdown = ref(false);

const drawer = ref(false);
const group = ref(null);
const links = [
    {
        title: 'Products',
        href: '/dashboard/products',
    },
    {
        title: 'Inventory',
        href: '/dashboard/inventory',
    },
];

watch(group, () => {
    drawer.value = false;
});
</script>

<template>
    <v-app theme="light">
        <v-layout>
            <v-app-bar color="primary">
                <v-app-bar-nav-icon icon="mdi-menu" @click.stop="drawer = !drawer"></v-app-bar-nav-icon>
                <v-toolbar-title>
                    <slot name="title" />
                </v-toolbar-title>
                <v-btn variant="text" icon="mdi-magnify"></v-btn>
                <v-btn variant="text" icon="mdi-filter"></v-btn>
                <v-btn variant="text" icon="mdi-dots-vertical"></v-btn>
            </v-app-bar>
            <v-navigation-drawer v-model="drawer" location="left" temporary>
                <v-list>
                    <v-list-item v-for="(link, i) in links" :key="i">
                        <Link :href="link.href">{{ link.title }}</Link>
                    </v-list-item>
                </v-list>
            </v-navigation-drawer>

            <v-main>
                <slot />
            </v-main>
        </v-layout>
    </v-app>
</template>
