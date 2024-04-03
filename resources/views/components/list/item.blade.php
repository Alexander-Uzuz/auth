<div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
    <dt class="text-sm font-medium leading-6 text-gray-900">{{ $name }}</dt>
    <dd class="mt-1 flex text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
        <span class="flex-grow">{{ $value }}</span>

        @isset($action)
            <span class="ml-4 flex-shrink-0">
                <button type="button"
                    class="rounded-md bg-white font-medium text-indigo-600 hover:text-indigo-500">{{ $action }}</button>
            </span>
        @endisset
    </dd>
</div>
