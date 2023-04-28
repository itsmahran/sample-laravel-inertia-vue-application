<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { defineProps, ref, reactive, onMounted } from 'vue'
import { router, usePage } from '@inertiajs/vue3'

const page = usePage()

const props = defineProps({
    book: Object,
})

const form = reactive({
    title: props.book.title,
    year_published: props.book.year_published,
    description: props.book.description,
    author: props.book.author,
})

function submit() {
    console.log('aa');
    router.put('/books/' + props.book.id, form)
}
</script>

<template>
    <AppLayout title="Create new book">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Update book: {{ props.book.title }}
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-12 py-12">
                    <!-- <h1 class="text-2xl font-bold mb-10">Create new book</h1> -->
                    <form @submit.prevent="submit">
                        <div class="mb-6">
                            <label for="book_title" class="block mb-2 text-sm font-medium">Title</label>
                            <input type="text" id="book_title" v-model="form.title"
                                class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-1/2 p-2.5"
                                placeholder="Harry Potter" required>
                        </div>
                        <div class="mb-6">
                            <label for="book_description" class="block mb-2 text-sm font-medium">Description</label>
                            <textarea id="book_description" v-model="form.description"
                                class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-1/2 p-2.5"
                                cols="30" rows="3"></textarea>
                        </div>
                        <div class="mb-6">
                            <label for="year_published" class="block mb-2 text-sm font-medium">Year Published</label>
                            <input type="text" id="year_published" v-model="form.year_published"
                                class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5"
                                placeholder="1997" required>
                        </div>
                        <div class="mb-6">
                            <label for="book_author" class="block mb-2 text-sm font-medium">Author</label>
                            <input type="text" id="book_author" v-model="form.author"
                                class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-1/2 p-2.5"
                                placeholder="Stephen King" required>
                        </div>
                        <button type="submit"
                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
