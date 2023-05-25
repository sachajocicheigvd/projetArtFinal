<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Example Component</div>

                    <div class="card-body">
                        I'm an example componentT.

                    </div>
                </div>
            </div>
        </div>
    </div>
    {{ test.x }}
    {{ test.y }}
</template>

<script setup>

     const test =  defineProps(['x','y']);
  console.log(test);
</script>
