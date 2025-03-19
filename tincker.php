<div class="news-ticker">
    <div class="news-ticker-content" id="news-content">Φόρτωση ιατρικών ειδήσεων...</div>
	</div>

	<script>
		async function fetchRSS() {
			const proxyUrl = 'https://api.rss2json.com/v1/api.json?rss_url=';
			const feedUrl = 'https://www.euro2day.gr/rss.ashx?chiid=899011';
			try {
				const response = await fetch(proxyUrl + encodeURIComponent(feedUrl));
				const data = await response.json();
				const items = data.items;
				let newsHtml = '';
				items.forEach(item => {
					newsHtml += `📰 ${item.title} | `;
				});
				document.getElementById('news-content').innerHTML = newsHtml;
			} catch (error) {
				console.error('Σφάλμα κατά τη λήψη των ειδήσεων:', error);
			}
		}

		fetchRSS();
		setInterval(fetchRSS, 60000); // Ανανεώνει τις ειδήσεις κάθε 60 δευτερόλεπτα
	</script>