<div class="news-ticker">
    <div class="news-ticker-content" id="news-ticker-content">Φόρτωση ιατρικών ειδήσεων...</div>
</div>

<script>
        async function fetchRSS() {
            const apiUrl = 'https://api.rss2json.com/v1/api.json';
            const rssUrl = 'https://www.euro2day.gr/rss.ashx?chiid=899011';
            const apiKey = 'igtgdwgzrwnlib7gcuir381od8xswpbbgkalrj7l'; // Βάλε το API Key σου εδώ

            try {
                const response = await fetch(`${apiUrl}?rss_url=${encodeURIComponent(rssUrl)}&api_key=${apiKey}&count=15`);
                const data = await response.json();

                if (data.status !== 'ok') throw new Error(data.message);

                const items = data.items;
                if (!items || items.length === 0) {
                    document.getElementById('news-ticker-content').textContent = 'Δεν βρέθηκαν ειδήσεις!';
                    return;
                }

                let newsHtml = items.map(item => `<a href="${item.link}" target="_blank" style="color: black; text-decoration: none;">📰 ${item.title}</a>`).join(' | ');
                document.getElementById('news-ticker-content').innerHTML = newsHtml;

            } catch (error) {
                console.error('Σφάλμα κατά τη λήψη των ειδήσεων:', error);
                document.getElementById('news-ticker-content').textContent = 'Αποτυχία φόρτωσης ειδήσεων!';
            }
        }

        fetchRSS();
        setInterval(fetchRSS, 60000); // Ανανέωση κάθε 60 δευτερόλεπτα
    </script>
