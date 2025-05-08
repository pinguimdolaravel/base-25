<div>
    Dashboard

    <div class="font-mono bg-black text-green-600 text-4xl p-20">
        user_id: {{ auth()->user()->id }}<br>
        impersonate_as: {{ session('impersonate_as') }}


    </div>
</div>
