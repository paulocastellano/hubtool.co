<script setup>
import { ref } from "vue";
import { useForm, usePage } from "@inertiajs/vue3";
import ActionSection from "@/Components/ActionSection.vue";
import Button from "@/Components/Button.vue";
import DialogModal from "@/Components/DialogModal.vue";
import InputError from "@/Components/InputError.vue";
import Input from "@/Components/Input.vue";

const project = usePage().props.auth.user.current_project;

const confirmingUserDeletion = ref(false);
const passwordInput = ref(null);

const form = useForm({
    password: "",
});

const confirmUserDeletion = () => {
    confirmingUserDeletion.value = true;

    setTimeout(() => passwordInput.value.focus(), 250);
};

const deleteUser = () => {
    form.delete(route("account.destroy"), {
        errorBag: "userDeletion",
        preserveScroll: true,
        onSuccess: () => closeModal(),
        onError: () => passwordInput.value.focus(),
        onFinish: () => form.reset(),
    });
};

const closeModal = () => {
    confirmingUserDeletion.value = false;

    form.reset();
};
</script>

<template>
    <ActionSection>
        <template #title> Delete Account </template>

        <template #description> Permanently delete your account. </template>

        <template #content>
            <div class="max-w-xl text-sm text-dark dark:text-white">
                Once your account is deleted, all of its resources and data will
                be permanently deleted. Before deleting your account, please
                download any data or information that you wish to retain.
            </div>

            <div class="mt-5">
                <Button class="btn-danger" @click="confirmUserDeletion">
                    Delete Account
                </Button>
            </div>
        </template>
    </ActionSection>

    <!-- Delete Account Confirmation Modal -->
    <DialogModal
        :show="confirmingUserDeletion"
        @close="closeModal"
        max-width="md"
    >
        <template #title> Delete Account </template>

        <template #content>
            <p>
                Are you sure you want to delete your account? Once your account
                is deleted, all of its resources and data will be permanently
                deleted. Please enter your password to confirm you would like to
                permanently delete your account.
            </p>

            <div class="mt-4">
                <Input
                    ref="passwordInput"
                    v-model="form.password"
                    type="password"
                    class="mt-1 block w-full"
                    placeholder="Password"
                    @keyup.enter="deleteUser"
                />

                <InputError :message="form.errors.password" class="mt-2" />
            </div>
        </template>

        <template #footer>
            <Button class="btn-secondary" @click="closeModal"> Cancel </Button>

            <Button
                :class="{
                    'btn-danger': true,
                    'ml-3': true,
                    'opacity-25': form.processing,
                }"
                :disabled="form.processing"
                @click="deleteUser"
            >
                Delete Account
            </Button>
        </template>
    </DialogModal>
</template>
