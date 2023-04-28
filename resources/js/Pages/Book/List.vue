<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { Link } from '@inertiajs/vue3'
import { reactive, onMounted, ref } from 'vue'
import { router } from '@inertiajs/vue3'

let data = ref([]);
onMounted(async () => {
    getBooks();
});

function getBooks() {
    axios.get('/books/get')
        .then(response => {
            data.value = response.data;
        });
}

const handleDeleteBook = (id) => {
    router.delete('/books/' + id, {
        onSuccess: () => getBooks(),
    })
};
</script>

<template>
    <AppLayout title="Books">
        <template #header>
            <div class="flex flex-row">
                <div class="basis-3/4">
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                        Books
                    </h2>
                </div>
                <div class="basis-1/4">
                    <Link href="/books/create"
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded float-right">Create new
                    </Link>
                </div>
            </div>

        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-12 py-12">
                    <!-- <h1 class="text-2xl font-bold mb-10">Books</h1> -->

                    <div class="relative overflow-x-auto shadow-md ">
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400 border-2">
                            <thead class="text-xs text-gray-700 uppercase ">
                                <tr class="border-b-2">
                                    <th scope="col" class="px-6 py-3">
                                        Title
                                    </th>
                                    <th scope="col" class="px-6 py-3 bg-gray-100">
                                        Description
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Year Published
                                    </th>
                                    <th scope="col" class="px-6 py-3 bg-gray-100">
                                        Author
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(book, index) in data" :key="index" class="border-b">
                                    <td class="px-6 py-4">
                                        {{ book.title }}
                                    </td>
                                    <td class="px-6 py-4 bg-gray-100">
                                        {{ book.description }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ book.year_published }}
                                    </td>
                                    <td class="px-6 py-4 bg-gray-100">
                                        {{ book.author }}
                                    </td>
                                    <td class="px-6 py-4">
                                        <Link :href="`/books/${book.id}/edit`"
                                            class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</Link>
                                        <button class="font-medium text-blue-600 dark:text-blue-500 hover:underline ml-3"
                                            @click="handleDeleteBook(book.id)">Delete</button>
                                        <!-- <Link :href="`/books/${book.id}`" method="delete"
                                            class="font-medium text-blue-600 dark:text-blue-500 hover:underline ml-3">Delete
                                        </Link> -->
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
