<table>
    <tr style="min-height: 50px;">
        <th>{{ __('front.name') }}</th>
        <td>{{ $contactForm['name'] }}</td>
    </tr>
    <tr style="min-height: 50px;">
        <th>{{ __('front.email') }}</th>
        <td>{{ $contactForm['email'] }}</td>
    </tr>
    @if(isset($contactForm['phone']))
    <tr style="min-height: 50px;">
        <th>{{ __('front.phone') }}</th>
        <td>{{ $contactForm['phone'] }}</td>
    </tr>
    @endif
    <tr style="min-height: 50px;">
        <th>{{ __('front.message') }}</th>
        <td>{{ $contactForm['message'] }}</td>
    </tr>
    @if(isset($contactForm['link']))
        <tr style="min-height: 50px;">
            <th>URL</th>
            <td><a href="{{ $contactForm['link'] }}">{{ $contactForm['link'] }}</a></td>
        </tr>
    @endif
</table>