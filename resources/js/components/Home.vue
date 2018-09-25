<template>
    <section class="hero is-primary is-medium">
        <!-- Hero head: will stick at the top -->
        <div class="hero-head">
            <navbar></navbar>
        </div>

        <!-- Hero content: will be in the middle -->
        <div class="hero-body">
            <div class="container has-text-centered">
                <h1 class="title">
                    My Vue.JS Demo
                </h1>
                <h2 class="subtitle">
                    Learning...
                </h2>
            </div>
        </div>
        <div class="tabs box" style="width:50%;margin: 0 auto;margin-bottom: 5px;">
            <router-link to = "/blog">Blog</router-link>
            <router-link to = "/about">About</router-link>
            <router-link to = "/contact">contact us</router-link>
        </div>
        <!-- Hero footer: will stick at the bottom -->
        <div style="background-color: white">
            <router-view></router-view>
        </div>
    </section>

</template>
<script>
    import navbar from './navbar/navbar';

    export default {
        navbar:navbar,
        components: {
            'navbar' : navbar
        },

    }
</script>