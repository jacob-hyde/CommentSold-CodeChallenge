<template>

    <Head title="Products" />
    <AuthenticatedLayout>
        <template v-slot:title>Products</template>
        <v-container>
            <v-card theme="light">
                <v-card-title class="d-flex justify-space-between">
                    <h2 class="headline mb-0">Products</h2>
                    <Link href="/dashboard/products/create">
                    <v-btn color="primary">Add Product</v-btn>
                    </Link>
                </v-card-title>
                <v-card-text>
                    <v-data-table-server :items="products" :headers="headers" :loading="loading"
                        :items-length="totalItems" @update:options="loadProducts" :items-per-page="itemsPerPage"
                        item-value="product_name" class="elevation-1">
                        <template v-slot:item.actions="{ item }">
                            <Link :href="`/dashboard/products/${item.columns.id}`">
                            <v-btn color="primary" icon="mdi-pencil" size="small" variant="plain"></v-btn>
                            </Link>
                            <v-btn @click="deleteProduct(item.columns.id)" color="red" icon="mdi-delete" size="small"
                                variant="plain"></v-btn>
                        </template>
                        <template v-slot:item.sku="{ item }">
                            {{ item.columns.sku.join(', ') }}
                        </template>
                    </v-data-table-server>
                </v-card-text>
            </v-card>
        </v-container>
    </AuthenticatedLayout>
</template>
<script setup>
import { ref, reactive } from 'vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
import { VDataTableServer } from 'vuetify/labs/VDataTable'
import axios from 'axios'
let headers = [
    { title: 'ID', value: 'id', key: 'id', sortable: true },
    { title: 'Name', value: 'product_name', key: 'product_name', sortable: true },
    { title: 'Style', value: 'style', key: 'style', sortable: true },
    { title: 'Brand', value: 'brand', key: 'brand', sortable: true },
    { title: 'SKU\'s', value: 'skus', key: 'sku', width: '20%', sortable: false },
    { title: 'Actions', value: 'actions', key: 'actions', sortable: false },
];
let products = ref([]);
let itemsPerPage = ref(100);
let totalItems = ref(0);
let loading = ref(false);
let sortBy = reactive([{ key: 'id', order: 'asc' }]);
let page = 1

const loadProducts = async (pagination) => {
    page = pagination.page
    itemsPerPage.value = pagination.itemsPerPage
    loading.value = true
    let url = `/api/products?page=${page}&per_page=${itemsPerPage.value}`;
    if (pagination.sortBy.length > 0) {
        sortBy = pagination.sortBy
        url += `&sort_by=${sortBy[0].key}&sort_order=${sortBy[0].order}`
    }
    let { data: response } = await axios.get(url)
    products.value = response.data
    itemsPerPage.value = response.meta.per_page
    totalItems.value = response.meta.total
    loading.value = false
}

const deleteProduct = async (id) => {
    let url = `/api/products/${id}`
    let { data: response } = await axios.delete(url)
    console.log(response)
    loadItems({ page: page, itemsPerPage: itemsPerPage.value, sortBy: sortBy })
}
</script>
