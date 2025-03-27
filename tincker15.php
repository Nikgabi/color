

<div class="news-ticker">
    <div class="news-ticker-content" id="news-ticker-content">Φόρτωση ιατρικών ειδήσεων...</div>
</div>

<script>

async function fetchRSS() {
    const apiUrl = 'https://api.rss2json.com/v1/api.json';
    const rssUrl = 'https://www.euro2day.gr/rss.ashx?chiid=899011';
    const apiKey = 'igtgdwgzrwnlib7gcuir381od8xswpbbgkalrj7l';

    try {
        const response = await fetch(`${apiUrl}?rss_url=${encodeURIComponent(rssUrl)}&api_key=${apiKey}&count=15`);
        const data = await response.json();

        if (data.status !== 'ok') throw new Error(data.message);

        const items = data.items;
        if (!items || items.length === 0) {
            document.getElementById('news-ticker-content').textContent = 'Δεν βρέθηκαν ειδήσεις!';
            return;
        }

        let newsHtml = items.map(item => `<span><a href="${item.link}" target="_blank" style="color: black; text-decoration: none;">📰 ${item.title}</a></span>`).join(' ');

        const tickerContent = document.getElementById('news-ticker-content');
        tickerContent.innerHTML = newsHtml;

        // Καθορισμός animation μόνο αφού φορτώσουν οι ειδήσεις
        const contentWidth = tickerContent.scrollWidth;
        const viewportWidth = window.innerWidth;

        const duration = Math.max(30, contentWidth / viewportWidth * 20); // Ρυθμίζει το χρόνο αναλογικά με το μήκος των ειδήσεων

        tickerContent.style.animation = `ticker ${duration}s linear infinite`;
        
    } catch (error) {
        console.error('Σφάλμα κατά τη λήψη των ειδήσεων:', error);
        document.getElementById('news-ticker-content').textContent = 'Αποτυχία φόρτωσης ειδήσεων!';
    }
}

fetchRSS();
setInterval(fetchRSS, 60000);

</script>
