<script setup>
import { Head } from "@inertiajs/vue3";

import AppLayout from "@/Layouts/Master.vue";
import SectionBorder from "@/Components/SectionBorder.vue";
import DeleteAccountForm from "./Partials/DeleteAccountForm.vue";
import UpdatePasswordForm from "./Partials/UpdatePasswordForm.vue";
import UpdateProfileInformationForm from "./Partials/UpdateProfileInformationForm.vue";

defineProps({
    mustVerifyEmail: Boolean,
    status: Boolean,
    hasPassword: Boolean,
});
</script>

<template>
    <Head title="Account" />

    <AppLayout max-width="2xl">
        <template #header>
            <div class="sm:flex sm:items-center">
                <div class="sm:flex-auto">
                    <h1 class="page-title">Account</h1>
                </div>
            </div>
        </template>

        <div class="pb-4">
            <div>
                <UpdateProfileInformationForm
                    :must-verify-email="mustVerifyEmail"
                    :status="status"
                />
                <SectionBorder />
            </div>

            <div>
                <UpdatePasswordForm :has-password="hasPassword" />
                <SectionBorder />
            </div>

            <div>
                <DeleteAccountForm />
            </div>
        </div>
    </AppLayout>
</template>
