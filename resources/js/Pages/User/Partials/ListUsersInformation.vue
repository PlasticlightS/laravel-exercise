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
    users: {
        type: Object,
    },
    trashed: {
        type: Boolean,
    },
});

const form = useForm({
});

const restoreUser = (user) => {
    form.post(route('users.restore', user.id), {
        preserveScroll: true,
        onFinish: () => form.reset(),
    });
};

const deleteUser = (user) => {
    form.delete(route('users.delete', user.id), {
        preserveScroll: true,
        onFinish: () => form.reset(),
    });
};

</script>

<template>

    <div class="min-w-full">

        <div class="flex flex-col">
            <div class="overflow-x-auto shadow-md sm:rounded-lg">
                <div class="inline-block min-w-full align-middle">
                    <div class="overflow-hidden ">
                        <table class="min-w-full divide-y divide-gray-200 table-fixed dark:divide-gray-700">
                            <thead class="bg-gray-100 dark:bg-gray-700">
                            <tr>

                                <th scope="col" class="py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                                    First Name
                                </th>
                                <th scope="col" class="py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                                    Last Name
                                </th>
                                <th scope="col" class="py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                                    Email
                                </th>
                                <th scope="col" class="p-4">
                                    <span class="sr-only">Edit</span>
                                </th>
                            </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700">
                            <tr
                                v-for="user in users"
                                :key="user.id"
                            >

                                <td class="py-4 px-6 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ user.firstname }}</td>
                                <td class="py-4 px-6 text-sm font-medium text-gray-500 whitespace-nowrap dark:text-white">
                                    {{ user.lastname }}</td>
                                <td class="py-4 px-6 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ user.email }}</td>
                                <td class="py-4 px-6 text-sm font-medium text-right whitespace-nowrap">
                                    <Link
                                        v-if="!trashed"
                                        class="text-blue-600 dark:text-blue-500 hover:underline"
                                        :href="route('users.show', user)">
                                        View
                                    </Link>
                                    <Link
                                        v-if="!trashed"
                                        class="text-blue-600 dark:text-blue-500 hover:underline"
                                        :href="route('users.edit', user)">
                                        Edit
                                    </Link>
                                    <PrimaryButton
                                        v-if="trashed"
                                        class="ml-3"
                                        :class="{ 'opacity-25': form.processing }"
                                        :disabled="form.processing"
                                        @click="restoreUser(user)"
                                    >
                                        Restore
                                    </PrimaryButton>
                                    <DangerButton
                                        v-if="trashed"
                                        class="ml-3"
                                        :class="{ 'opacity-25': form.processing }"
                                        :disabled="form.processing"
                                        @click="deleteUser(user)"
                                    >
                                        Permanently Delete
                                    </DangerButton>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
