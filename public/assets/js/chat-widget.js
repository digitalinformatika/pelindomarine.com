/**
 * Chatbot "Marime" — widget chat mengambang PT Pelindo Marine Service.
 * Porting dari chat-widget.tsx (React) ke vanilla JS.
 */
(function () {
    'use strict';

    var EMAIL_PATTERN = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    var LOGO = 'images/logo-chatbot.png';

    var COPY = {
        id: {
            assistantTitle: 'Marine Chatbot (Marime)',
            online: 'Online',
            closeChat: 'Tutup chat',
            openChat: 'Buka chat',
            introBody: 'Ahoy! Saya Marime siap membantu Anda menemukan informasi terkait PT Pelindo Marine Service. Sebelum memulai, boleh kenalan dulu? Cukup isi nama dan email Anda agar kami dapat memberikan dukungan terbaik jika diperlukan.',
            nameLabel: 'Nama',
            namePlaceholder: 'Nama kamu',
            emailLabel: 'Email',
            emailPlaceholder: 'nama@email.com',
            nameRequired: 'Nama wajib diisi ya 🙏',
            emailInvalid: 'Format emailnya sepertinya belum tepat, coba dicek lagi ya 🙏',
            startButton: 'Mulai Chat 💬',
            greeting: function (name) { return 'Halo, ' + name + '! 👋 Senang banget kamu mampir. Ada yang bisa aku bantu seputar layanan Pelindo Marine hari ini? 😊'; },
            messagePlaceholder: 'Tulis pesan...',
            sendMessage: 'Kirim pesan',
            genericError: 'Waduh, sepertinya ada kendala teknis 🙏 Boleh dicoba kirim lagi?'
        },
        en: {
            assistantTitle: 'Marine Chatbot (Marime)',
            online: 'Online',
            closeChat: 'Close chat',
            openChat: 'Open chat',
            introBody: "Ahoy! I'm Marime, ready to help you find information related to PT Pelindo Marine Service. Before we get started, may I get to know you a little better? Please provide your name and email address so we can offer the best possible support and follow up if needed.",
            nameLabel: 'Name',
            namePlaceholder: 'Your name',
            emailLabel: 'Email',
            emailPlaceholder: 'name@email.com',
            nameRequired: 'Please enter your name 🙏',
            emailInvalid: "That email doesn't look quite right, mind checking it again? 🙏",
            startButton: 'Start Chat 💬',
            greeting: function (name) { return 'Hi, ' + name + "! 👋 So glad you stopped by. What can I help you with about Pelindo Marine's services today? 😊"; },
            messagePlaceholder: 'Type a message...',
            sendMessage: 'Send message',
            genericError: 'Oops, looks like we hit a technical hiccup 🙏 Mind trying again?'
        }
    };

    var state = {
        open: false,
        lang: 'id',
        stage: 'form', // 'form' | 'chat'
        visitorName: '',
        visitorEmail: '',
        messages: [],  // { role: 'user'|'model', content, escalated }
        loading: false
    };

    function esc(text) {
        var div = document.createElement('div');
        div.textContent = text;
        return div.innerHTML;
    }

    function renderInline(text) {
        return esc(text)
            .replace(/\*\*([^*]+)\*\*/g, '<strong>$1</strong>')
            .replace(/\*([^*]+)\*/g, '<em>$1</em>');
    }

    // Format balasan model: paragraf, bullet list, numbered list, **bold**
    function formatMessage(content) {
        var blocks = content.trim().split(/\n{2,}/);
        var html = '';

        blocks.forEach(function (block) {
            var lines = block.split('\n').filter(function (l) { return l.trim() !== ''; });
            if (!lines.length) return;

            var isBullet = lines.every(function (l) { return /^[-*]\s+/.test(l.trim()); });
            var isNumbered = lines.every(function (l) { return /^\d+[.)]\s+/.test(l.trim()); });

            if (isBullet) {
                html += '<ul>' + lines.map(function (l) {
                    return '<li>' + renderInline(l.trim().replace(/^[-*]\s+/, '')) + '</li>';
                }).join('') + '</ul>';
            } else if (isNumbered) {
                html += '<ol>' + lines.map(function (l) {
                    return '<li>' + renderInline(l.trim().replace(/^\d+[.)]\s+/, '')) + '</li>';
                }).join('') + '</ol>';
            } else {
                html += '<p>' + lines.map(renderInline).join('<br>') + '</p>';
            }
        });

        return html;
    }

    var root, panel, bodyEl, toggleBtn;

    function t() { return COPY[state.lang]; }

    function avatar(size) {
        return '<span class="mrm-avatar" style="width:' + size + 'px;height:' + size + 'px"><img src="' + LOGO + '" alt="Marime"></span>';
    }

    function render() {
        var copy = t();

        panel.className = 'mrm-panel' + (state.open ? ' mrm-open' : '');
        document.body.classList.toggle('mrm-chat-open', state.open);
        toggleBtn.innerHTML = state.open ? '<span class="mrm-x">✕</span>' : '<img src="' + LOGO + '" alt="Marime">';
        toggleBtn.setAttribute('aria-label', state.open ? copy.closeChat : copy.openChat);

        var header =
            '<div class="mrm-header">' +
                avatar(40) +
                '<div class="mrm-headtext">' +
                    '<p class="mrm-title">' + copy.assistantTitle + '</p>' +
                    '<p class="mrm-online"><span class="mrm-dot"></span>' + copy.online + '</p>' +
                '</div>' +
                '<div class="mrm-langs">' +
                    '<button type="button" data-mrm-lang="id" class="' + (state.lang === 'id' ? 'mrm-lang-active' : '') + '">ID</button>' +
                    '<button type="button" data-mrm-lang="en" class="' + (state.lang === 'en' ? 'mrm-lang-active' : '') + '">EN</button>' +
                '</div>' +
                '<button type="button" class="mrm-close" data-mrm-close aria-label="' + copy.closeChat + '">✕</button>' +
            '</div>';

        var content;

        if (state.stage === 'form') {
            content =
                '<form class="mrm-intro" data-mrm-start>' +
                    '<p class="mrm-introbody">' + copy.introBody + '</p>' +
                    '<label>' + copy.nameLabel +
                        '<input type="text" name="name" placeholder="' + copy.namePlaceholder + '" value="' + esc(state.visitorName) + '">' +
                    '</label>' +
                    '<label>' + copy.emailLabel +
                        '<input type="email" name="email" placeholder="' + copy.emailPlaceholder + '" value="' + esc(state.visitorEmail) + '">' +
                    '</label>' +
                    '<p class="mrm-error" hidden></p>' +
                    '<button type="submit" class="mrm-start">' + copy.startButton + '</button>' +
                '</form>';
        } else {
            var msgs = state.messages.map(function (m) {
                if (m.role === 'user') {
                    return '<div class="mrm-row mrm-row-user"><div class="mrm-bubble mrm-bubble-user">' + esc(m.content) + '</div></div>';
                }
                return '<div class="mrm-row">' + avatar(28) +
                    '<div class="mrm-bubble' + (m.escalated ? ' mrm-bubble-escalated' : '') + '">' + formatMessage(m.content) + '</div></div>';
            }).join('');

            if (state.loading) {
                msgs += '<div class="mrm-row">' + avatar(28) +
                    '<div class="mrm-bubble mrm-typing"><span></span><span></span><span></span></div></div>';
            }

            content =
                '<div class="mrm-messages">' + msgs + '</div>' +
                '<form class="mrm-inputbar" data-mrm-send>' +
                    '<input type="text" name="message" placeholder="' + copy.messagePlaceholder + '" autocomplete="off"' + (state.loading ? ' disabled' : '') + '>' +
                    '<button type="submit" aria-label="' + copy.sendMessage + '"' + (state.loading ? ' disabled' : '') + '>' +
                        '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19V5m0 0l-6 6m6-6l6 6"/></svg>' +
                    '</button>' +
                '</form>';
        }

        panel.innerHTML = header + content;

        var scroller = panel.querySelector('.mrm-messages');
        if (scroller) scroller.scrollTop = scroller.scrollHeight;

        var input = panel.querySelector('.mrm-inputbar input');
        if (input && state.open && !state.loading) input.focus();
    }

    function startChat(form) {
        var name = form.name.value.trim();
        var email = form.email.value.trim();
        var errEl = form.querySelector('.mrm-error');

        if (!name) {
            errEl.textContent = t().nameRequired;
            errEl.hidden = false;
            return;
        }
        if (!EMAIL_PATTERN.test(email)) {
            errEl.textContent = t().emailInvalid;
            errEl.hidden = false;
            return;
        }

        state.visitorName = name;
        state.visitorEmail = email;
        state.messages = [{ role: 'model', content: t().greeting(name.split(' ')[0]) }];
        state.stage = 'chat';
        render();
    }

    function sendMessage(form) {
        var text = form.message.value.trim();
        if (!text || state.loading) return;

        var history = state.messages.map(function (m) {
            return { role: m.role, content: m.content };
        });

        state.messages.push({ role: 'user', content: text });
        state.loading = true;
        render();

        fetch('chat', {
            method: 'POST',
            credentials: 'same-origin',
            headers: { 'Content-Type': 'application/json', Accept: 'application/json' },
            body: JSON.stringify({
                message: text,
                history: history,
                visitor_name: state.visitorName,
                visitor_email: state.visitorEmail,
                lang: state.lang
            })
        }).then(function (response) {
            return response.json();
        }).then(function (data) {
            state.messages.push({
                role: 'model',
                content: data.reply || t().genericError,
                escalated: !!data.escalated
            });
        }).catch(function () {
            state.messages.push({ role: 'model', content: t().genericError, escalated: true });
        }).then(function () {
            state.loading = false;
            render();
        });
    }

    function init() {
        root = document.createElement('div');
        root.id = 'mrm-chat';
        root.innerHTML = '<div class="mrm-panel"></div><button type="button" class="mrm-toggle"></button>';
        document.body.appendChild(root);

        panel = root.querySelector('.mrm-panel');
        toggleBtn = root.querySelector('.mrm-toggle');

        toggleBtn.addEventListener('click', function () {
            state.open = !state.open;
            render();
        });

        panel.addEventListener('click', function (e) {
            var langBtn = e.target.closest('[data-mrm-lang]');
            if (langBtn) {
                state.lang = langBtn.getAttribute('data-mrm-lang');
                render();
                return;
            }
            if (e.target.closest('[data-mrm-close]')) {
                state.open = false;
                render();
            }
        });

        panel.addEventListener('submit', function (e) {
            e.preventDefault();
            if (e.target.hasAttribute('data-mrm-start')) startChat(e.target);
            if (e.target.hasAttribute('data-mrm-send')) sendMessage(e.target);
        });

        render();
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', init);
    } else {
        init();
    }
})();
