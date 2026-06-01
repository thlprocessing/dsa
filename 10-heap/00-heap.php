<?php


/**
 * 
 * https://web.stanford.edu/class/archive/cs/cs161/cs161.1168/lecture4.pdf
 * https://doeken.org/blog/heaps-explained-in-php
 * 
 * Heap Draining: In PHP, iterating over an instance of SplHeap (like SplMinHeap) using foreach is destructive. As PHP loops through the heap, it extracts and removes elements from the heap to iterate over them.
 * 
 * 
 * Extracting a value from a Heap
 * 
 * We've seen how you can add a value to the Heap By injecting it, and then sifting it up. 
 * But how can you extract a value? It isn't as simple as removing the node, because that might cut the Tree in half. 
 * Take the Root-node for instance. On a Heap it's very likely you want to extract that value. But simply removing it will create two new Trees.
 * To avoid this Tree splitting, we need to replace (or swap) the Root-node with the last node. 
 * In a heap the last node can always be removed from a Tree, without corrupting it, because the Tree is already sorted.
 * However, when we swap the Root-node with the last node, and extract it, the Tree will no longer be a Heap at that point, because the wrong value will be at the top. 
 * So we need to turn this Tree into a Heap again, starting with the Root-node. 
 * This process is not as lengthy as turning an entire unsorted Tree into a Heap, because most of the Tree is already in the correct order.
 * 
 * 
 * 
 * Iterating over the Heap will essentially call extract() for every value. 
 * This means that those values are gone from the heap. 
 * If you call ::rewind() on the Heap, this will not return those values. Using ::current() or ::top() will return the current top value without removing it. 
 * When you call ::next() however, this will again extract the current value.
 * 
 * 
 * 
 * 
 * 
 * 
 * This happens because a heap is not a standard, flat array; it is a specialized tree structure. 
 * Iterating over a heap (like SplMinHeap or SplMaxHeap) via a foreach loop natively triggers its extract() method. 
 * In a heap data structure, removing the root element and restructuring the tree is the fundamental mechanism required to access the next highest (or lowest) priority item.
 * Why Heaps Extract ElementsWhen you iterate through a traditional array, PHP uses an internal pointer to jump from index to index. 
 * Heaps do not have standard, sequential indices that can be gracefully pointed to. 
 * Instead, heap structures enforce a specific rule: the highest-priority element is always at the root of the tree.
 * Because a standard foreach loop requires sequentially accessing elements, PHP achieves this on a heap by pulling the root element (extracting it), re-sorting the remaining tree to push the next priority element to the top, and repeating the process.
 * How to Loop Without Destroying the HeapIf you need to iterate over the elements in a heap's current order without removing them, you have two safe alternatives:Clone the heap: Iterate over a clone of the heap object. 
 * This way, the loop extracts and empties the cloned copy while preserving your original heap.
 * Convert to an array: Use iterator_to_array() to snapshot the heap's current elements into a standard PHP array, which can be safely looped over as many times as needed.
 */