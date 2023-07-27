<script setup>
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Link, useForm, usePage } from '@inertiajs/vue3';
import SelectInput from "@/Components/SelectInput.vue";

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

const form = useForm({
    prefixname: user.prefixname,
    firstname: user.firstname,
    middlename: user.middlename,
    lastname: user.lastname,
    suffixname: user.suffixname,
    email: user.email,
    photo: user.photo,
    id: user.id,
});
</script>

<template>
    <section>
        <header>
            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">User Information</h2>

            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                Update your account's profile information and email address.
            </p>
        </header>

        <form @submit.prevent="form.patch(route('users.update', user))" class="mt-6 space-y-6">
            <div>
                <InputLabel for="email" value="Email" />

                <TextInput
                    id="email"
                    type="email"
                    class="mt-1 block w-full"
                    v-model="form.email"
                    required
                    autocomplete="username"
                />

                <InputError class="mt-2" :message="form.errors.email" />
            </div>

            <div>
                <InputLabel for="prefixname" value="Prefix Name" />

                <SelectInput
                    id="prefixname"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.prefixname"
                    autofocus
                    autocomplete="prefixname"
                />

                <InputError class="mt-2" :message="form.errors.prefixname" />
            </div>

            <div>
                <InputLabel for="firstname" value="First Name" />

                <TextInput
                    id="firstname"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.firstname"
                    autofocus
                    autocomplete="firstname"
                />

                <InputError class="mt-2" :message="form.errors.firstname" />
            </div>

            <div>
                <InputLabel for="middlename" value="Middle Name" />

                <TextInput
                    id="middlename"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.middlename"
                    autofocus
                    autocomplete="middlename"
                />

                <InputError class="mt-2" :message="form.errors.middlename" />
            </div>

            <div>
                <InputLabel for="lastname" value="Last Name" />

                <TextInput
                    id="lastname"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.lastname"
                    required
                    autofocus
                    autocomplete="lastname"
                />

                <InputError class="mt-2" :message="form.errors.lastname" />
            </div>

            <div>
                <InputLabel for="suffixname" value="Suffix Name" />

                <TextInput
                    id="suffixname"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.suffixname"
                    autofocus
                    autocomplete="suffixname"
                />

                <InputError class="mt-2" :message="form.errors.suffixname" />
            </div>

            <div>
                <InputLabel for="photo" value="Photo" />

                <TextInput
                    id="photo"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.photo"
                    autofocus
                    autocomplete="photo"
                />

                <InputError class="mt-2" :message="form.errors.photo" />
            </div>

            <div v-if="mustVerifyEmail && user.email_verified_at === null">
                <p class="text-sm mt-2 text-gray-800 dark:text-gray-200">
                    Your email address is unverified.
                    <Link
                        :href="route('verification.send')"
                        method="post"
                        as="button"
                        class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"
                    >
                        Click here to re-send the verification email.
                    </Link>
                </p>

                <div
                    v-show="status === 'verification-link-sent'"
                    class="mt-2 font-medium text-sm text-green-600 dark:text-green-400"
                >
                    A new verification link has been sent to your email address.
                </div>
            </div>

            <div class="flex items-center gap-4">
                <PrimaryButton :disabled="form.processing">Save</PrimaryButton>

                <Transition
                    enter-active-class="transition ease-in-out"
                    enter-from-class="opacity-0"
                    leave-active-class="transition ease-in-out"
                    leave-to-class="opacity-0"
                >
                    <p v-if="form.recentlySuccessful" class="text-sm text-gray-600 dark:text-gray-400">Saved.</p>
                </Transition>
            </div>
        </form>
    </section>
</template>
