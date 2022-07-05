<script setup>
import { ref } from 'vue';
import { useForm } from '@inertiajs/inertia-vue3';
import JetActionSection from '@/Jetstream/ActionSection.vue';
import JetDialogModal from '@/Jetstream/DialogModal.vue';
import JetDangerButton from '@/Jetstream/DangerButton.vue';
import JetInput from '@/Jetstream/Input.vue';
import JetInputError from '@/Jetstream/InputError.vue';
import JetSecondaryButton from '@/Jetstream/SecondaryButton.vue';

const confirmingUserDeletion = ref(false);
const passwordInput = ref(null);

const form = useForm({
    password: '',
});

const confirmUserDeletion = () => {
    confirmingUserDeletion.value = true;

    setTimeout(() => passwordInput.value.focus(), 250);
};

const deleteUser = () => {
    form.delete(route('current-user.destroy'), {
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
    <JetActionSection>
        <template #title>
            アカウント消去
        </template>

        <template #description>
            アカウントを完全に削除
        </template>

        <template #content>
            <div class="max-w-xl text-sm text-gray-600">
                アカウントが削除されると、そのリソースとデータはすべて永久に削除されます。アカウントを削除する前に、保持したいデータまたは情報をダウンロードしてください。
            </div>

            <div class="mt-5">
                <JetDangerButton @click="confirmUserDeletion">
                    アカウントの消去
                </JetDangerButton>
            </div>

            <!-- Delete Account Confirmation Modal -->
            <JetDialogModal :show="confirmingUserDeletion" @close="closeModal">
                <template #title>
                    アカウントの消去
                </template>

                <template #content>
                    本当にアカウントを削除するのですか？アカウントを削除すると、そのリソースとデータはすべて永久に削除されます。パスワードを入力して、アカウントを削除することを確認してください。

                    <div class="mt-4">
                        <JetInput
                            ref="passwordInput"
                            v-model="form.password"
                            type="password"
                            class="mt-1 block w-3/4"
                            placeholder="Password"
                            @keyup.enter="deleteUser"
                        />

                        <JetInputError :message="form.errors.password" class="mt-2" />
                    </div>
                </template>

                <template #footer>
                    <JetSecondaryButton @click="closeModal">
                        キャンセル
                    </JetSecondaryButton>

                    <JetDangerButton
                        class="ml-3"
                        :class="{ 'opacity-25': form.processing }"
                        :disabled="form.processing"
                        @click="deleteUser"
                    >
                        アカウントの削除
                    </JetDangerButton>
                </template>
            </JetDialogModal>
        </template>
    </JetActionSection>
</template>
