<template>
    <div>
        <v-text-field v-model="search" label="Search..." prepend-inner-icon="mdi-magnify"></v-text-field>
    </div>
    <div>
        <v-data-table-server v-if="paginate" ref="table" :items="invetoryData" :headers="headers"
            :items-per-page="itemsPerPage" item-value="product_name" class="elevation-1" :loading="loading"
            :items-length="totalItems" @update:options="loadInventory">
        </v-data-table-server>
        <v-data-table v-else :items="invetoryData" :headers="headers" :items-per-page="itemsPerPage"
            item-value="product_name" class="elevation-1"></v-data-table>
    </div>
</template>
<script setup>
import { ref, reactive, watch } from 'vue';
import { debounce } from 'lodash';
import { VDataTable, VDataTableServer } from 'vuetify/labs/VDataTable'
import axios from 'axios';
const props = defineProps({
    inventory: {
        type: Array,
        required: false,
    },
    paginate: {
        type: Boolean,
        required: false,
        default: true,
    },
});
const headers = [
    { title: 'Product ID', value: 'product_id', key: 'product_id', sortable: true },
    { title: 'Product Name', value: 'product_name', key: 'product_name', sortable: true },
    { title: 'SKU', value: 'sku', key: 'sku', sortable: true },
    { title: 'Quantity', value: 'quantity', key: 'quantity', sortable: true },
    { title: 'Color', value: 'color', key: 'color', sortable: true },
    { title: 'Price', value: 'price_cents', key: 'price_cents', sortable: true }, //The value is actuallly in dolalrs, but I am using the column name for time stake
    { title: 'Cost', value: 'cost_cents', key: 'cost_cents', sortable: true }, //The value is actuallly in dolalrs, but I am using the column name for time stake
];

let page = 1
const invetoryData = ref(props.inventory ? [...props.inventory] : []);
const itemsPerPage = ref(10);
const loading = ref(false);
const totalItems = ref(0);
const sortBy = reactive([{ key: 'product_name', order: 'asc' }]);
const search = ref('');
const table = ref(null);

const loadInventory = async (pagination) => {
    page = pagination.page
    itemsPerPage.value = pagination.itemsPerPage
    loading.value = true
    let url = `/api/inventory?page=${page}&per_page=${itemsPerPage.value}`;
    if (pagination.sortBy.length > 0) {
        sortBy.value = pagination.sortBy
        url += `&sort_by=${sortBy[0].key}&sort_order=${sortBy[0].order}`
    }
    if (search.value) {
        url += `&search=${search.value}`
    }
    let { data: response } = await axios.get(url)
    invetoryData.value = response.data
    itemsPerPage.value = response.meta.per_page
    totalItems.value = response.meta.total
    loading.value = false
}
watch(search, (value) => {
    debounce(() => {
        loadInventory({ page, itemsPerPage: itemsPerPage.value, sortBy: sortBy })
    }, 500)()
})
</script>
