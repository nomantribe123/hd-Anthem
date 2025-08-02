<div class="plp-layout-selector flex items-center gap-1">
    <button type="button" class="btn"
        :class="isGridView() ? 'btn--grey' : 'border-transparent'"
        @click="setGridView()"
        aria-label="Grid View">
        <svg viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
            <rect x="4" y="4" width="9.33333" height="8" fill="currentColor"/>
            <rect x="4" y="16" width="9.33333" height="8" fill="currentColor"/>
            <rect x="4" y="28" width="9.33333" height="8" fill="currentColor"/>
            <rect x="15.333" y="4" width="9.33333" height="8" fill="currentColor"/>
            <rect x="15.333" y="16" width="9.33333" height="8" fill="currentColor"/>
            <rect x="15.333" y="28" width="9.33333" height="8" fill="currentColor"/>
            <rect x="26.667" y="4" width="9.33333" height="8" fill="currentColor"/>
            <rect x="26.667" y="16" width="9.33333" height="8" fill="currentColor"/>
            <rect x="26.667" y="28" width="9.33333" height="8" fill="currentColor"/>
        </svg>
        <span>
            Grid View
        </span>
    </button>
    <button type="button" class="btn"
        :class="isListView() ? 'btn--grey' : 'border-transparent'"
        @click="setListView()"
        aria-label="List View">
        <svg viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
            <rect x="4.5" y="4.5" width="7" height="7" fill="currentColor" stroke="currentColor"/>
            <rect x="4.5" y="16.5" width="7" height="7" fill="currentColor" stroke="currentColor"/>
            <rect x="4.5" y="28.5" width="7" height="7" fill="currentColor" stroke="currentColor"/>
            <rect x="14.5" y="4.5" width="21" height="7" fill="currentColor" stroke="currentColor"/>
            <rect x="14.5" y="16.5" width="21" height="7" fill="currentColor" stroke="currentColor"/>
            <rect x="14.5" y="28.5" width="21" height="7" fill="currentColor" stroke="currentColor"/>
        </svg>
        <span>
            List View
        </span>
    </button>
</div>