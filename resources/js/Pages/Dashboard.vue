<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { Link } from '@inertiajs/vue3';
</script>

<template>

    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template v-slot:title>Dashboard</template>
        <v-container>
            <v-row align="center">
                <v-col cols="6">
                    <Link href="/dashboard/products">
                    <v-btn color="primary" height="100%" width="100%">Products</v-btn>
                    </Link>
                </v-col>
                <v-col cols="6">
                    <v-btn color="secondary" height="100%" width="100%">Orders</v-btn>
                </v-col>
            </v-row>
        </v-container>
    </AuthenticatedLayout>
</template>
<style scoped>
.v-container {
    height: 100%;
}

.v-row {
    height: 100%;
}

.v-col {
    height: 100%;
}
</style>
