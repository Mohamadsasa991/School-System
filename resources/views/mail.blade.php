@foreach ($students as $student )
<h2>Hello {{ $student->full_name }}</h2>
<p>Your child's access code is:</p>
<h1 style="color:blue;">{{ $student->code }}</h1>
@endforeach

<p>Use this code in the app to link your child.</p>
