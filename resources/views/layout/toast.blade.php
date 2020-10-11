<script>
    function toasthandler() {
        return {
            notices: [],
            visible: [],
            add(notice) {
                notice.id = Date.now()
                this.notices.push(notice)
                this.fire(notice.id)
            },
            fire(id) {
                let notice = this.notices.find(notice => notice.id == id);
                let dur = notice.dur ? notice.dur : 2000;
                this.visible.push(notice)
                const timeShown = dur * this.visible.length
                setTimeout(() => {
                    this.remove(id)
                }, timeShown)
            },
            remove(id) {
                const notice = this.visible.find(notice => notice.id == id)
                const index = this.visible.indexOf(notice)
                this.visible.splice(index, 1)
            },

        };
    }
</script>
<div
    x-data="toasthandler()"
    class="fixed top-0 z-50 flex flex-col-reverse items-end justify-start w-screen"
    x-on:ltoast.window="add($event.detail)"
    style="pointer-events:none">
    <template x-for="notice of notices" :key="notice.id">
        <div
            x-show="visible.includes(notice)"
            x-transition:enter="transition ease-in duration-200"
            x-transition:enter-start="transform opacity-0 translate-y-2"
            x-transition:enter-end="transform opacity-100"
            x-transition:leave="transition ease-out duration-500"
            x-transition:leave-start="transform translate-x-0 opacity-100"
            x-transition:leave-end="transform translate-x-full opacity-0"
            @click="remove(notice.id)"
            class="mb-3 border font-sans w-full h-10 flex items-center justify-center shadow-lg font-semibold text-base cursor-pointer"
            :class="{
				'bg-green-200 text-green-500 border-green-300 ': notice.type === 'success',
				'bg-blue-100 text-blue-800 border-blue-800 ': notice.type === 'info',
				'bg-orange-100 text-orange-800 border-orange-800 ': notice.type === 'warning',
				'bg-red-200 text-error-color border-error-color': notice.type === 'error',
			 }"
            style="pointer-events:all"
            >
            <div class="flex items-center justify-between">
                <svg class="w-8 h-8" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path x-show="notice.type === 'success'" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    <path x-show="notice.type === 'info'" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    <path x-show="notice.type === 'warning'" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                    <path x-show="notice.type === 'error'" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <div class="ml-2" x-text="notice.message"></div>

            </div>
        </div>
    </template>
</div>
