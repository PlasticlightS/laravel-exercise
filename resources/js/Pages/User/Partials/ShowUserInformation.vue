<script setup>
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import {Head, Link, useForm, usePage} from '@inertiajs/vue3';
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import ApplicationLogo from "@/Components/ApplicationLogo.vue";
import DangerButton from "@/Components/DangerButton.vue";

defineProps({
    mustVerifyEmail: {
        type: Boolean,
    },
    status: {
        type: String,
    },
    user: {
        type: Object,
    },
});
const user = usePage().props.user;

</script>

<template>

    <div class="min-w-full">

        <div class="flex flex-col">
            <div class="overflow-x-auto sm:rounded-lg">
                <div class="inline-block min-w-full align-middle">
                    <div class="overflow-hidden ">
                        <table class="min-w-full divide-y divide-gray-200 table-fixed dark:divide-gray-700">
                            <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700">
                            <tr>
                                <td class="w-1/4 py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    Email</td>
                                <td class="py-4 px-6 font-bold text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ user.email }}</td>
                            </tr>
                            <tr>
                                <td class="w-1/4 py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    Prefix Name</td>
                                <td class="py-4 px-6 font-bold text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ user.prefixname }}</td>
                            </tr>
                            <tr>
                                <td class="w-1/4 py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    First Name</td>
                                <td class="py-4 px-6 font-bold text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ user.firstname }}</td>
                            </tr>
                            <tr>
                                <td class="w-1/4 py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    Middle Name</td>
                                <td class="py-4 px-6 font-bold text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ user.middlename }}</td>
                            </tr>
                            <tr>
                                <td class="w-1/4 py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    Last Name</td>
                                <td class="py-4 px-6 font-bold text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ user.lastname }}</td>
                            </tr>
                            <tr>
                                <td class="w-1/4 py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    Suffix Name</td>
                                <td class="py-4 px-6 font-bold text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ user.suffixname }}</td>
                            </tr>
                            <tr>
                                <td class="w-1/4 py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    Photo</td>
                                <td class="py-4 px-6 font-bold text-gray-900 whitespace-nowrap dark:text-white">
                                    <img class="w-48 h-48" src="{{ user.photo }}"></td>
                            </tr>
                            </tbody>
                        </table>

                        <Link
                            :href="route('users.edit', user)">
                            <PrimaryButton :href="route('users.create')"> Edit User </PrimaryButton>
                        </Link>

                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
