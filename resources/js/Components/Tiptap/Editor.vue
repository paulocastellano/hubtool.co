<script setup>
import { ref, watch, onMounted } from "vue";
import { Menu, MenuButton, MenuItem, MenuItems } from "@headlessui/vue";
import {
    IconPhotoPlus,
    IconLoader,
    IconBold,
    IconItalic,
    IconUnderline,
    IconH1,
    IconH2,
    IconH3,
    IconList,
    IconLink,
    IconClearFormatting,
    IconBrandYoutube,
    IconBrandVimeo,
} from "@tabler/icons-vue";

import helper from "@/helper";

import Button from "@/Components/Button.vue";
import DialogModal from "@/Components/DialogModal.vue";
import Input from "@/Components/Input.vue";
import InputError from "@/Components/InputError.vue";

import { Editor, EditorContent } from "@tiptap/vue-3";
import Code from "@tiptap/extension-code";
import Underline from "@tiptap/extension-underline";
import Link from "@tiptap/extension-link";
import Image from "@tiptap/extension-image";
import Placeholder from "@tiptap/extension-placeholder";
import StarterKit from "@tiptap/starter-kit";
import Iframe from "./Iframe.ts";

const props = defineProps({
    modelValue: {
        type: String,
        default: "",
    },

    placeholder: {
        type: String,
        default: "Type something...",
        required: false,
    },
    editable: {
        type: Boolean,
        default: true,
        required: false,
    },
});

const emit = defineEmits(["update:modelValue"]);

const editable = ref(props.editable);
const file = ref(null);
const editor = ref(null);
const uploadProgress = ref(false);

watch(
    () => props.modelValue,
    (value) => {
        const isSame = editor.value.getHTML() === value;
        if (isSame) {
            return;
        }

        editor.value.commands.setContent(props.modelValue, false);
    }
);

watch(
    () => props.editable,
    (value) => {
        editor.value.options.editable = value;
        editable.value = value;
    }
);

onMounted(() => {
    editor.value = new Editor({
        editable: editable.value,
        content: props.modelValue,
        extensions: [
            Underline,
            Link,
            StarterKit,
            Iframe,
            Image.configure({ inline: true }),
            Placeholder.configure({
                placeholder: props.placeholder,
            }),
            Code,
        ],
        autofocus: true,
        editorProps: {
            attributes: {
                class: "prose prose-sm dark:prose-invert prose-img:rounded-lg rounded-lg max-w-full text-gray-800 dark:text-gray-200 px-4 py-4 focus:outline-none tiptap-height overflow-auto min-w-full",
            },
        },

        onUpdate: () => {
            emit("update:modelValue", editor.value.getHTML());
        },
    });
});

const addImage = () => {
    file.value.click();

    file.value.onchange = () => {
        uploadProgress.value = true;

        const formData = new FormData();
        formData.append("image", file.value.files[0]);

        axios
            .post(route("tools.image-handler"), formData)
            .then((data) => {
                if (data.data.path) {
                    editor.value
                        .chain()
                        .focus()
                        .setImage({ src: data.data.path })
                        .run();
                }
                uploadProgress.value = false;
            })
            .catch((error) => {
                console.log(error);
                // if (error.response.status === 422) {
                //     alert(error.response.data.message);
                // }
            });
    };
};

const setLabel = (label) => {
    const html = `<div data-type="changelog-label" class="inline-flex bg-${label.color}-100 text-${label.color}-500 ring-1 ring-inset ring-${label.color}-300 ring-opacity-40 text-xs truncate font-medium px-2 py-1 rounded" name="${label.name}">${label.name}</div>`;

    editor.value.commands.insertHTML(html);
};

// youtube
const youtubeUrl = ref("");
const showYoutubeModal = ref(false);
const youtubeUrlIsValid = ref("");
const setYoutube = () => {
    const VIDEO_ID = helper.getYouTubeVideoIdFromUrl(youtubeUrl.value);

    if (!VIDEO_ID) {
        youtubeUrlIsValid.value = "Invalid YouTube URL";
        return;
    }

    editor.value
        .chain()
        .focus()
        .setIframe({ src: `https://www.youtube.com/embed/${VIDEO_ID}` })
        .run();
    showYoutubeModal.value = false;
    youtubeUrl.value = "";
};

// vimeo
const vimeoUrl = ref("");
const vimeoUrlIsValid = ref("");
const showVimeoModal = ref(false);
const setVimeo = () => {
    const VIDEO_ID = helper.getVimeoIdFromUrl(vimeoUrl.value);

    if (!VIDEO_ID) {
        vimeoUrlIsValid.value = "Invalid Vimeo URL";
        return;
    }

    editor.value
        .chain()
        .focus()
        .setIframe({ src: `https://player.vimeo.com/video/${VIDEO_ID}` })
        .run();
    showVimeoModal.value = false;
    vimeoUrl.value = "";
};

// link
const linkToInsert = ref("");
const showLinkModal = ref(false);
const setLink = () => {
    editor.value
        .chain()
        .focus()
        .extendMarkRange("link")
        .setLink({ href: linkToInsert.value })
        .run();

    showLinkModal.value = false;
    linkToInsert.value = "";
};
</script>

<template>
    <div class="tiptap-editor">
        <editor-content
            :class="{
                'border-t border-x bg-white dark:bg-gray-900 dark:text-gray-300 border-gray-200 dark:border-gray-800 rounded-t max-w-full ': true,
            }"
            :editor="editor"
        />

        <div
            class="flex justify-center bg-white dark:bg-gray-900 border-b border-r border-l border-gray-200 dark:border-gray-800 rounded-b px-2 py-0.5"
            v-if="editor"
        >
            <div
                class="opacity-40 hover:opacity-100 transition flex items-center mb-1 space-x-1.5"
            >
                <button
                    @click="addImage"
                    class="p-1 hover:bg-gray-200 rounded"
                    v-tooltip="{
                        content: 'Image Upload',
                        placement: 'top',
                    }"
                >
                    <input
                        type="file"
                        name="file"
                        id="file"
                        ref="file"
                        class="hidden"
                    />

                    <IconLoader
                        v-if="uploadProgress"
                        class="h-4 w-4 text-gray-500 animate-spin"
                    />
                    <IconPhotoPlus v-else class="h-4 w-4 text-gray-500" />
                </button>
                <button
                    v-tooltip="{
                        content: 'Bold',
                        placement: 'top',
                    }"
                    @click="editor.chain().focus().toggleBold().run()"
                    :class="{
                        'focus:outline-none p-1 hover:bg-gray-200 rounded': true,
                        'is-active': editor.isActive('bold'),
                    }"
                >
                    <IconBold class="h-4 w-4 text-gray-500" />
                </button>
                <button
                    v-tooltip="{
                        content: 'Italic',
                        placement: 'top',
                    }"
                    @click="editor.chain().focus().toggleItalic().run()"
                    :class="{
                        'focus:outline-none p-1 hover:bg-gray-200 rounded': true,
                        'is-active': editor.isActive('italic'),
                    }"
                >
                    <IconItalic class="h-4 w-4 text-gray-500" />
                </button>
                <button
                    v-tooltip="{
                        content: 'Underline',
                        placement: 'top',
                    }"
                    @click="editor.chain().focus().toggleUnderline().run()"
                    :class="{
                        'focus:outline-none p-1 hover:bg-gray-200 rounded': true,
                        'is-active': editor.isActive('underline'),
                    }"
                >
                    <IconUnderline class="h-4 w-4 text-gray-500" />
                </button>
                <button
                    v-tooltip="{
                        content: 'H1',
                        placement: 'top',
                    }"
                    @click="
                        editor.chain().focus().toggleHeading({ level: 1 }).run()
                    "
                    :class="{
                        'focus:outline-none p-1 hover:bg-gray-200 rounded': true,
                        'is-active': editor.isActive('heading', { level: 1 }),
                    }"
                >
                    <IconH1 class="h-4 w-4 text-gray-500" />
                </button>
                <button
                    v-tooltip="{
                        content: 'H2',
                        placement: 'top',
                    }"
                    @click="
                        editor.chain().focus().toggleHeading({ level: 2 }).run()
                    "
                    :class="{
                        'focus:outline-none p-1 hover:bg-gray-200 rounded': true,
                        'is-active': editor.isActive('heading', { level: 2 }),
                    }"
                >
                    <IconH2 class="h-4 w-4 text-gray-500" />
                </button>
                <button
                    v-tooltip="{
                        content: 'H3',
                        placement: 'top',
                    }"
                    @click="
                        editor.chain().focus().toggleHeading({ level: 3 }).run()
                    "
                    :class="{
                        'focus:outline-none p-1 hover:bg-gray-200 rounded': true,
                        'is-active': editor.isActive('heading', { level: 3 }),
                    }"
                >
                    <IconH3 class="h-4 w-4 text-gray-500" />
                </button>
                <button
                    v-tooltip="{
                        content: 'List',
                        placement: 'top',
                    }"
                    @click="editor.chain().focus().toggleBulletList().run()"
                    :class="{
                        'focus:outline-none p-1 hover:bg-gray-200 rounded': true,
                        'is-active': editor.isActive('bulletList'),
                    }"
                >
                    <IconList class="h-4 w-4 text-gray-500" />
                </button>
                <button
                    v-tooltip="{
                        content: 'Link',
                        placement: 'top',
                    }"
                    @click="showLinkModal = true"
                    :class="{
                        'focus:outline-none p-1 hover:bg-gray-200 rounded': true,
                        'is-active': editor.isActive('link'),
                    }"
                >
                    <IconLink class="h-4 w-4 text-gray-500" />
                </button>

                <button
                    v-tooltip="{
                        content: 'YouTube Embed',
                        placement: 'top',
                    }"
                    @click="showYoutubeModal = true"
                    :class="{
                        'focus:outline-none p-1 hover:bg-gray-200 rounded': true,
                        'is-active': editor.isActive('link'),
                    }"
                >
                    <IconBrandYoutube class="h-4 w-4 text-gray-500" />
                </button>

                <button
                    v-tooltip="{
                        content: 'Vimeo Embed',
                        placement: 'top',
                    }"
                    @click="showVimeoModal = true"
                    :class="{
                        'focus:outline-none p-1 hover:bg-gray-200 rounded': true,
                        'is-active': editor.isActive('link'),
                    }"
                >
                    <IconBrandVimeo class="h-4 w-4 text-gray-500" />
                </button>

                <button
                    v-tooltip="{
                        content: 'Clear Formatting',
                        placement: 'top',
                    }"
                    @click="editor.chain().focus().clearNodes().run()"
                    :class="{
                        'p-1 hover:bg-gray-200 rounded': true,
                        'is-active': editor.isActive('clearNodes'),
                    }"
                >
                    <IconClearFormatting class="h-4 w-4 text-gray-500" />
                </button>
            </div>
            <div
                v-if="!editable"
                class="absolute h-[30px] bg-transparent w-full max-w-sm"
            />
        </div>
    </div>

    <!-- Youtube Embed Modal -->
    <DialogModal
        max-width="md"
        :show="showYoutubeModal"
        @close="showYoutubeModal = null"
    >
        <template #title>YouTube Embed </template>

        <template #content>
            <div class="grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-6">
                <div class="sm:col-span-6">
                    <Input
                        id="title"
                        name="title"
                        type="text"
                        v-model="youtubeUrl"
                        placeholder="Paste the link of your YouTube video"
                        class="w-full"
                    />
                    <InputError :message="youtubeUrlIsValid" class="mt-2" />
                </div>
            </div>
        </template>

        <template #footer>
            <Button @click="setYoutube" class="btn-primary"> Embed </Button>
        </template>
    </DialogModal>

    <!-- Vimeo Embed Modal -->
    <DialogModal
        max-width="md"
        :show="showVimeoModal"
        @close="showVimeoModal = null"
    >
        <template #title>Vimeo Embed </template>

        <template #content>
            <div class="grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-6">
                <div class="sm:col-span-6">
                    <Input
                        id="title"
                        name="title"
                        type="text"
                        v-model="vimeoUrl"
                        placeholder="Paste the link of your Vimeo video"
                        class="w-full"
                    />
                    <InputError :message="vimeoUrlIsValid" class="mt-2" />
                </div>
            </div>
        </template>

        <template #footer>
            <Button @click="setVimeo" class="btn-primary"> Embed </Button>
        </template>
    </DialogModal>

    <!-- Link Embed Modal -->
    <DialogModal
        max-width="md"
        :show="showLinkModal"
        @close="showLinkModal = null"
    >
        <template #title>Add Link to </template>

        <template #content>
            <div class="grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-6">
                <div class="sm:col-span-6">
                    <Input
                        id="title"
                        name="title"
                        type="text"
                        v-model="linkToInsert"
                        placeholder="Paste the link"
                        class="w-full"
                    />
                </div>
            </div>
        </template>

        <template #footer>
            <Button @click="setLink" class="btn-primary"> Link </Button>
        </template>
    </DialogModal>
</template>

<style>
.tiptap-editor .tiptap-height {
    min-height: 40px;
    max-height: 600px;
    max-width: 100% !important;
}

.tiptap-editor p.is-editor-empty:first-child::before {
    color: #adb5bd;
    content: attr(data-placeholder);
    float: left;
    height: 0;
    pointer-events: none;
}
</style>
