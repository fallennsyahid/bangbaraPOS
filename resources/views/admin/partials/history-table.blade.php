<tbody class="bg-[#CAAC44]" id="productTable">
    @foreach ($histories as $index => $history)
        <tr class="hover:bg-yellow-300" data-category="{{ $history->id }}">
            <td class="px-6 py-4 font-medium text-sm">#{{ $index + 1 }}</td>
            <td class="px-6 py-4 font-medium text-sm">{{ $history->customer_name }}</td>
            <td class="px-6 py-4 font-medium text-sm">{{ $history->customer_phone }}</td>
            <td class="px-6 py-4 font-medium text-sm">Rp {{ number_format($history->total_price, 2) }}</td>
            <td class="px-6 py-4 font-medium text-sm">{{ $history->payment_method }}</td>
            <td class="px-6 py-4 font-medium text-sm">{{ $history->payment_photo }}</td>
            <td class="px-6 py-4 flex gap-3 mt-4">
                <button class="bg-green-500 text-white text-sm px-4 py-2 rounded-md shadow-md hover:bg-green-600">
                    <a href="{{ route('histories.show', $history->id) }}">Detail</a>
                </button>
                <form id="delete-form-{{ $history->id }}" action="{{ route('histories.destroy', $history->id) }}"
                    method="POST" onsubmit="return confirm('Are you sure you want to delete this category?');">
                    @csrf
                    @method('DELETE')
                    <button type="button"
                        class="bg-red-600 text-white text-sm px-4 py-2 rounded-md shadow-md hover:bg-red-700">
                        Delete
                    </button>
                </form>
            </td>
        </tr>
    @endforeach
</tbody>
