<?php
/**
 * Filters Template Part
 * Expects: $categories, $current_category
 */

$current_category = $args['current_category'] ?? '';
$categories = $args['categories'] ?? [];

if (!$categories || !is_array($categories)) {
    return;
}

?>
<!-- Mobile: Category Selection Button & Collapsible List -->
<div x-data="{ open: false }" class="block lg:hidden w-full">
    <button
        @click="open = !open"
        class="border border-black px-8 py-4 flex flex-row justify-center w-full"
        :aria-expanded="open"
        aria-controls="mobile-category-list"
    >
        Category Selection
    </button>
    <div
        x-show="open"
        x-collapse
        id="mobile-category-list"
        class="mt-2 border overflow-hidden"
    >
        <ul>
            <li>
                <a href="<?php echo get_permalink(get_page_by_path('blogs')); ?>"
                   class="block px-8 py-4 border last:border-0 <?php echo (!is_category() && (!isset($current_category->term_id))) ? 'bg-[#31344A0A]' : ''; ?>">
                    View All
                </a>
            </li>
            <?php foreach ($categories as $category) : ?>
                <li>
                    <a href="<?php echo get_term_link($category); ?>"
                       class="block px-8 py-4 border last:border-b-0 <?php echo (isset($current_category->term_id) && $current_category->term_id === $category->term_id) ? 'bg-[#31344A0A]' : ''; ?>">
                        <?php echo $category->name; ?>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</div>

<!-- Desktop: Horizontal Category List -->
<div class="hidden lg:flex flex-nowrap justify-between">
    <div class="py-4">
        <a href="<?php echo get_permalink(get_page_by_path('blogs')); ?>" class="border px-8 py-4 text-nowrap <?php echo (!is_category() || (!isset($current_category->term_id))) ? 'border-black bg-[#31344A0A]' : 'border-transparent'; ?>">
            View All
        </a>
    </div>
    <div class="overflow-hidden ml-auto">
        <ul class="flex flex-nowrap items-center overflow-auto py-4">
            <?php foreach ($categories as $category) : ?>
                <li>
                    <a href="<?php echo get_term_link($category); ?>"
                    class="border px-8 py-4 text-nowrap <?php echo (isset($current_category->term_id) && $current_category->term_id === $category->term_id) ? 'border-black bg-[#31344A0A]' : 'border-transparent'; ?>">
                        <?php echo $category->name; ?>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</div>
