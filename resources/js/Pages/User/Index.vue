<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import ListUsersInformation from './Partials/ListUsersInformation.vue';
import {Head, Link, router} from '@inertiajs/vue3';
import PrimaryButton from "@/Components/PrimaryButton.vue";

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
</script>

<template>
    <Head title="Users" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Users</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

                <div>
                    <Link
                        :href="route('users.create')">
                        <PrimaryButton :href="route('users.create')"> Create User </PrimaryButton>
                    </Link>
                </div>

                <div class="mt-2 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <ListUsersInformation
                        :must-verify-email="mustVerifyEmail"
                        :status="status"
                        :users="users"
                        :trashed="trashed"
                        class="max-w-xl"
                    />
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
