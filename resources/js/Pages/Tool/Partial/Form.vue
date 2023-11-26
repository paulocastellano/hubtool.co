<script setup>
import { ref, watch } from "vue";
import { useForm } from "@inertiajs/vue3";

import Tiptap from "@/Components/Tiptap/Editor.vue";
import Button from "@/Components/Button.vue";
import FormSection from "@/Components/FormSection.vue";
import Input from "@/Components/Input.vue";
import InputError from "@/Components/InputError.vue";
import Label from "@/Components/Label.vue";
import Select from "@/Components/Select.vue";
import SectionBorder from "@/Components/SectionBorder.vue";

const emits = defineEmits(["form:submitted"]);

const { form } = defineProps({
    form: {
        type: Object,
        required: true,
    },
});

const photoPreview = ref(null);
const photoInput = ref(null);

// const store = () => {
//     if (photoInput.value) {
//         form.photo = photoInput.value.files[0];
//     }

//     form.post(route("tools.store"), {
//         preserveScroll: true,
//         onSuccess: () => clearPhotoFileInput(),
//     });
// };

const selectNewPhoto = () => {
    photoInput.value.click();
};

const updatePhotoPreview = () => {
    const photo = photoInput.value.files[0];

    if (!photo) return;

    const reader = new FileReader();

    reader.onload = (e) => {
        photoPreview.value = e.target.result;

        form.photo = photo;
    };

    console.log(form);

    reader.readAsDataURL(photo);
};

const clearPhotoFileInput = () => {
    if (photoInput.value?.value) {
        photoInput.value.value = null;
    }
};
</script>

<template>
    <FormSection @submitted="$emit('form:submitted')">
        <template #form>
            <div class="col-span-6">
                <input
                    ref="photoInput"
                    type="file"
                    class="hidden"
                    @change="updatePhotoPreview"
                />

                <Label for="photo" value="Logo" :required="true" />

                <!-- Current Profile Photo -->
                <div v-show="!photoPreview" class="mt-2">
                    <img
                        :src="form.photo_url"
                        :alt="form.name"
                        class="rounded-md h-20 w-20 object-cover"
                    />
                </div>

                <!-- New Profile Photo Preview -->
                <div v-show="photoPreview" class="mt-2">
                    <span
                        class="block rounded-md w-20 h-20 bg-cover bg-no-repeat bg-center"
                        :style="
                            'background-image: url(\'' + photoPreview + '\');'
                        "
                    />
                </div>

                <Button
                    class="mt-2 mr-2 btn-secondary"
                    type="button"
                    @click.prevent="selectNewPhoto"
                >
                    Select A New Photo
                </Button>

                <InputError :message="form.errors.photo" class="mt-2" />
            </div>

            <div class="col-span-6 sm:col-span-3">
                <Label for="name" value="Name" :required="true" />

                <Input
                    id="name"
                    type="text"
                    placeholder="Tesla"
                    v-model="form.name"
                />

                <InputError :message="form.errors.name" class="mt-2" />
            </div>

            <div class="col-span-6 sm:col-span-3">
                <Label for="website" value="Website" :required="true" />
                <Input
                    id="website"
                    type="text"
                    placeholder="https://tesla.com"
                    v-model="form.website"
                />
                <InputError :message="form.errors.website" class="mt-2" />
            </div>

            <div class="col-span-6">
                <Label for="headline" value="Headline" :required="true" />
                <Input
                    id="headline"
                    type="text"
                    v-model="form.headline"
                    placeholder=""
                />
                <InputError :message="form.errors.headline" class="mt-2" />
            </div>

            <div class="col-span-6">
                <Label for="description" value="Description" :required="true" />

                <Tiptap
                    v-model="form.description"
                    placeholder="Enter a description.."
                />
                <InputError :message="form.errors.description" class="mt-2" />
            </div>

            <div class="col-span-6">
                <Label for="pricing" value="Pricing" :required="true" />

                <Select
                    id="pricing"
                    :values="{
                        FREE: 'Free',
                        FREEMIUM: 'Freemium',
                        PAID: 'Paid',
                    }"
                    class="mt-1 block w-full"
                    v-model="form.pricing"
                />

                <InputError :message="form.errors.pricing" class="mt-2" />
            </div>

            <SectionBorder />

            <div class="col-span-6">
                <div
                    class="block font-semibold text-base text-black dark:text-white mb-1"
                >
                    Social
                </div>
            </div>

            <div class="col-span-6 sm:col-span-3">
                <Label for="twitter" value="Twitter" />
                <Input
                    id="twitter"
                    type="text"
                    v-model="form.twitter"
                    placeholder="https://x.com/hubtool"
                />
                <InputError :message="form.errors.twitter" class="mt-2" />
            </div>

            <div class="col-span-6 sm:col-span-3">
                <Label for="facebook" value="Facebook" />
                <Input
                    id="facebook"
                    type="text"
                    v-model="form.facebook"
                    placeholder="https://facebook.com/hubtool"
                />
                <InputError :message="form.errors.facebook" class="mt-2" />
            </div>

            <div class="col-span-6 sm:col-span-3">
                <Label for="instagram" value="Instagram" />
                <Input
                    id="instagram"
                    type="text"
                    v-model="form.instagram"
                    placeholder="https://instagram.com/hubtool"
                />
                <InputError :message="form.errors.instagram" class="mt-2" />
            </div>

            <div class="col-span-6 sm:col-span-3">
                <Label for="youtube" value="Youtube" />
                <Input
                    id="youtube"
                    type="text"
                    v-model="form.youtube"
                    placeholder="https://youtube.com/hubtool"
                />
                <InputError :message="form.errors.youtube" class="mt-2" />
            </div>

            <div class="col-span-6 sm:col-span-3">
                <Label for="linkedin" value="Linkedin" />
                <Input
                    id="linkedin"
                    type="text"
                    v-model="form.linkedin"
                    placeholder="https://linkedin.com/in/hubtool"
                />
                <InputError :message="form.errors.linkedin" class="mt-2" />
            </div>

            <div class="col-span-6 sm:col-span-3">
                <Label for="github" value="Github" />
                <Input
                    id="github"
                    type="text"
                    v-model="form.github"
                    placeholder="https://github.com/hubtool"
                />
                <InputError :message="form.errors.github" class="mt-2" />
            </div>

            <div class="col-span-6 sm:col-span-3">
                <Label for="support_email" value="Support Email" />
                <Input
                    id="support_email"
                    type="text"
                    v-model="form.support_email"
                    placeholder=""
                />
                <InputError :message="form.errors.support_email" class="mt-2" />
            </div>

            <div class="col-span-6 sm:col-span-3">
                <Label for="apple_store_url" value="Apple Store URL" />
                <Input
                    id="apple_store_url"
                    type="text"
                    v-model="form.apple_store_url"
                    placeholder=""
                />
                <InputError
                    :message="form.errors.apple_store_url"
                    class="mt-2"
                />
            </div>

            <div class="col-span-6 sm:col-span-3">
                <Label for="google_play_url" value="Google Play URL" />
                <Input
                    id="google_play_url"
                    type="text"
                    v-model="form.google_play_url"
                    placeholder=""
                />
                <InputError
                    :message="form.errors.google_play_url"
                    class="mt-2"
                />
            </div>
        </template>

        <template #actions>
            <Button
                :class="{
                    'btn-primary w-full': true,
                    'opacity-25': form.processing,
                }"
                :disabled="form.processing"
            >
                Submit
            </Button>
        </template>
    </FormSection>
</template>
