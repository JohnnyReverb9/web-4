@extends("layouts.app")

@section("content")

    <div>
        <h1 style="font-size: 34px">Welcome!</h1>
    </div>
    <div class="stats-container">
        <div class="stats-item">
            <span>All posts:</span>
            <span>{{ $all_posts }}</span>
        </div>
        <div class="stats-item">
            <span>Published:</span>
            <span>{{ $published_posts }}</span>
        </div>
        <div class="stats-item">
            <span>Permanents:</span>
            <span>{{ $archived_posts }}</span>
        </div>
        <div class="stats-item">
            <span>Topics:</span>
            <span>{{ $topics }}</span>
        </div>
    </div>
    <div class="container" style="font-size: 22px">
        <h2>Asocial Network?..</h2>
        <p>Dive into a space where individuality thrives. Our platform is designed to empower your voice, letting you share thoughts, stories, and ideas with a community that values authenticity. Whether you're a blogger, artist, or just someone with something to say, Asocial Network provides the perfect canvas.</p>
        <h3>What Can You Do Here?</h3>
        <ul>
            <li><strong>Create Posts:</strong> share your thoughts, experiences, and insights. Whether it's a quick update or an in-depth article, your words matter.</li>
            <li><strong>Add Images:</strong> a picture is worth a thousand words. Enhance your Posts with images to tell your story more vividly.</li>
            <li><strong>Edit and Delete:</strong> flexibility is key. Modify your Posts as your thoughts evolve or remove them when they no longer represent you.</li>
            <li><strong>Mind the Time:</strong> you will have only 24 hours to edit or delete your Posts after release.</li>
            <li><strong>Permanent Posts:</strong> mark important Posts as Permanent to keep them at the forefront of your profile.</li>
        </ul>
        <h3>Why Asocial Network?</h3>
        <p>We believe in the power of individual expression. Our platform is user-friendly, secure, and designed to keep your content front and center. Connect with like-minded individuals, discover new perspectives, and make your mark.</p>
        <h3>Can I Try It?</h3>
        <p>Sure. Go to Posts page and make your first Post OR go to Topics and discuss about Permanents.</p>
        <h2>Important!</h2>
        <h3>Community Guidelines: What Not to Post</h3>
        <p>To maintain a respectful and safe environment, please follow these guidelines:</p>
        <ul>
            <li><strong>Prohibited Content:</strong> hate speech, harassment, illegal activities, graphic violence, adult content, misinformation, and spam.</li>
            <li><strong>Respect Intellectual Property:</strong> don't post content that infringes on others' rights.</li>
            <li><strong>Privacy Matters:</strong> respect others' privacy and don't share personal information without consent.</li>
            <li><strong>Keep it Civil:</strong> avoid personal attacks, inflammatory language, and trolling.</li>
        </ul>
        <p>Violating these guidelines may result in content removal, account suspension, or a permanent ban. Thank you for your cooperation. Enjoy Asocial Network responsibly.</p>
        <h3>Enjoy?</h3>
        <p>Enjoy.</p>
    </div>


@endsection
