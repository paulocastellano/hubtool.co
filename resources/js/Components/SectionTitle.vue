<template>
    <div class="md:col-span-1 flex justify-between">
        <div class="flex flex-1 flex-col">
            <div class="flex items-center justify-between">
                <h3
                    class="text-lg font-medium text-gray-900 dark:text-gray-100"
                >
                    <slot name="title" />
                </h3>

                <slot name="titleActions" />
            </div>

            <p class="mt-1 text-sm font-light text-gray-400 dark:text-gray-400">
                <slot name="description" />
            </p>
        </div>
    </div>
</template>
