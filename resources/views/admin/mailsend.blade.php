<p>候補ID：{{ $candidate->id }}</p>
<p>飼育場所：{{ $candidate->place_name }}</p>
<p>住所：{{ $candidate->place_address }}</p>
<p>電話番号：{{ $candidate->phonenumber }}</p>
<p>のクーポンが使用されました。</p>

<p>~~~~~~~~~~~~~~~~~~~~~</p>
<p>クーポン内容</p>
<p>{{ $candidate->coupon }}</p@>
<p>~~~~~~~~~~~~~~~~~~~~~</p>