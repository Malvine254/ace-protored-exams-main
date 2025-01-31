<div x-data="{
    hoverCardHovered: false,
    hoverCardDelay: 200,
    hoverCardLeaveDelay: 300,
    hoverCardTimout: null,
    hoverCardLeaveTimeout: null,
    hoverCardEnter() {
        clearTimeout(this.hoverCardLeaveTimeout);
        if (this.hoverCardHovered) return;
        clearTimeout(this.hoverCardTimout);
        this.hoverCardTimout = setTimeout(() => {
            this.hoverCardHovered = true;
        }, this.hoverCardDelay);
    },
    hoverCardLeave() {
        clearTimeout(this.hoverCardTimout);
        if (!this.hoverCardHovered) return;
        clearTimeout(this.hoverCardLeaveTimeout);
        this.hoverCardLeaveTimeout = setTimeout(() => {
            this.hoverCardHovered = false;
        }, this.hoverCardLeaveDelay);
    }
}" class="relative" @mouseover="hoverCardEnter()" @mouseleave="hoverCardLeave()">
    <div>
        {{ $anchor }}
    </div>
    <div x-show="hoverCardHovered" class="absolute top-4 max-w-lg mt-5 z-30 translate-y-3 right-0" x-cloak>
        <div x-show="hoverCardHovered"
            class="min-w-[250px] md:min-w-[300px] h-auto bg-white  dark:bg-gray-700 dark:text-white space-x-3 rounded-md shadow-[rgba(17,_17,_26,_0.1)_0px_0px_16px]"
            x-transition>
            {{ $slot }}
        </div>
    </div>
</div>
