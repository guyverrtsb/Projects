var chat = {}

chat.fetch_messages = function () {
	$.ajax({
		url: 'ajax/chat.php',
		type: 'post',
		data: { method: 'fetch' },
		success: function(data) {
			$('.chat .messages').html(data);
		}
	});
}

chat.throw_message = function (message) {
	if ($.trim(message).length != 0) {
		$.ajax({
			url: 'ajax/chat.php',
			type: 'post',
			data: { method: 'throw', message: message },
			success: function(data) {
				chat.fetch_messages();
				chat.entry.val('');
			}
		});
	}
}

chat.entry = $('.chat .entry');
chat.entry.bind('keydown', function(e) {
	if (e.keyCode === 13 && e.shiftKey === false) {
		chat.throw_message($(this).val());
		e.preventDefault();
	}
});

chat.interval = setInterval(chat.fetch_messages, 2000);
chat.fetch_messages();