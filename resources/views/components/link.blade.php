<a {{$attributes}} @click.prevent="$splade.visit('{{$attributes->get('href')}}')">{{$slot}}</a>
