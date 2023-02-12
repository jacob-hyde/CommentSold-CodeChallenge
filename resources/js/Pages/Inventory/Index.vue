<template>

    <Head title="Invetory" />
    <AuthenticatedLayout>
        <template v-slot:title>Inventory</template>
        <v-container>
            <v-card theme="light">
                <v-card-title>
                    <h2 class="headline mb-0">Inventory</h2>
                </v-card-title>
                <v-card-text>
                    <v-row class="mb-0" justify="center">
                        <v-col cols="2">
                            <v-card theme="light" color="blue">
                                <v-card-title class="text-center">
                                    <h2 class="headline mb-0 text-wrap">Total Inventory Quantity:</h2>
                                </v-card-title>
                                <v-card-text class="text-center">
                                    <h1 class="font-weight-bold text-h5">{{ total_inventory }}</h1>
                                </v-card-text>
                            </v-card>
                        </v-col>
                    </v-row>
                    <InventoryTable />
                </v-card-text>
            </v-card>
        </v-container>
    </AuthenticatedLayout>
</template>
<script setup>
import { Head } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import InventoryTable from '@/Components/Inventory/InventoryTable.vue';
const props = defineProps({
    total_inventory: {
        type: Number,
        required: true,
    },
});
</script>
