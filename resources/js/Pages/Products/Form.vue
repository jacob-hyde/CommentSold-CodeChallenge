<template>

    <Head :title="product ? `Edit Product: ${product.product_name}` : `Add Product`" />
    <AuthenticatedLayout>
        <template v-slot:title>{{ product? `Edit Product: ${product.product_name}` : `Add Product` }}</template>
        <v-container>
            <v-card theme="light">
                <v-card-title>
                    <h2 class="headline mb-0">{{ product? `Edit Product: ${product.product_name}` : `Add Product` }}
                    </h2>
                </v-card-title>
                <v-card-text>
                    <v-form ref="productForm" @submit.prevent="onSubmit">
                        <v-text-field class="mb-4" label="Product Name" :rules="rules.product_name"
                            v-model="productData.product_name"></v-text-field>
                        <v-textarea class="mb-4" label="Description" v-model="productData.description"
                            :rules="rules.description"></v-textarea>
                        <v-row>
                            <v-col cols="6">
                                <v-text-field label="Style" v-model="productData.style"
                                    :rules="rules.style"></v-text-field>
                            </v-col>
                            <v-col cols="6">
                                <v-text-field label="Brand" v-model="productData.brand"
                                    :rules="rules.brand"></v-text-field>
                            </v-col>
                        </v-row>
                        <v-row>
                            <v-col cols="6">
                                <v-text-field label="Product Type" v-model="productData.product_type"
                                    :rules="rules.product_type"></v-text-field>
                            </v-col>
                            <v-col cols="6">
                                <v-text-field label="Shipping Price" type="number" v-model="productData.shipping_price"
                                    :rules="rules.shipping_price"></v-text-field>
                            </v-col>
                        </v-row>
                        <v-textarea label="Note" v-model="productData.note"></v-textarea>
                        <div class="text-center">
                            <v-btn type="submit" color="primary">Submit</v-btn>
                        </div>
                    </v-form>
                </v-card-text>
            </v-card>
        </v-container>
    </AuthenticatedLayout>
</template>
<script setup>
import { ref, reactive } from 'vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { router, Head } from '@inertiajs/vue3';
const props = defineProps({
    product: {
        type: Object,
        required: false,
    },
});
const productForm = ref(null);
const rules = {
    product_name: [(v) => !!v || 'Product Name is required'],
    description: [(v) => !!v || 'Description is required'],
    style: [(v) => !!v || 'Style is required'],
    brand: [(v) => !!v || 'Brand is required'],
    product_type: [(v) => !!v || 'Product Type is required'],
    shipping_price: [(v) => !!v || 'Shipping Price is required'],
};
let productData = reactive({ ...props.product } ?? {
    product_name: null,
    description: null,
    style: null,
    brand: null,
    product_type: null,
    shipping_price: null,
    note: null,
});

const onSubmit = () => {
    productForm.value.validate().then((valid) => {
        if (valid.valid) {
            productData.shipping_price = Math.ceil(parseFloat(productData.shipping_price) * 100);
            if (props.product) {
                router.put(route('products.update', props.product.id), productData);
            } else {
                router.post(route('products.store'), productData);
            }
        }
    });
};
</script>
