<template>
    <div>
        <button type="submit" class="block w-full px-4 py-2 text-base leading-5 text-gray-700 text-left hover:text-primary focus:outline-none focus:text-primary transition" v-if="as == 'button'">
            <slot></slot>
        </button>

        <a :href="href" class="block px-4 py-2 text-base leading-5 text-gray-700 hover:text-primary focus:outline-none focus:text-primary transition" v-else-if="as =='a'">
            <slot></slot>
        </a>

        <Link :href="href" class="block px-4 py-2 text-base leading-5 text-gray-700 hover:text-primary focus:outline-none focus:text-primary transition" v-else>
            <slot></slot>
        </Link>
    </div>
</template>

<script>
    import { defineComponent } from 'vue';
    import { Link } from '@inertiajs/inertia-vue3';

    export default defineComponent({
        components: {
            Link,
        },
        props: ['href', 'as']
    })
</script>
