@foreach(App\Enums\CourieredStatusLabel::cases() as $status)
    <p class="white">
        <a class="btn btn-light" href="students.php?std_id={{ $student->id }}&name={{ $name }}&date={{ date("d-m-Y") }}&status={{ $status }}&timing_data=1">{{ $status }}</a>
        : {{ $student->getCardDeliveryDate($name, $loop->iteration) }}
    </p>
@endforeach