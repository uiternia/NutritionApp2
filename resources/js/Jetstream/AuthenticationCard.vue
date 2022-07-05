<template>
    <div class="img min-h-screen flex  sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
        <div>
            <slot name="logo" />
        </div>
        <div class="w-full sm:max-w-md mt-10 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
            <slot />
        </div>
    </div>
</template>
<style>
.img {
    height: 100vh;
    width: 100%;
    background-image: url("/storage/topPc.JPG");
    background-size: auto;
}
</style>
