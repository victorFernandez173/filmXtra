<template>
    <button
        class="w-full text-white bg-flamingo hover:bg-black hover:text-flamingo focus:bg-flamingo focus:ring-flamingo focus:border-flamingo focus:outline-none font-medium rounded-lg text-sm px-5 py-2.5 text-center"
    >
        <slot />
    </button>
</template>
<style scoped>
button {
    background:  #e37f81;
    color: white;
}
button:hover{
    color: black;
    background: #e37f81;
}
</style>
