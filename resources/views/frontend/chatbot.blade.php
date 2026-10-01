{{-- ================================================================
     GMET Chatbot Widget
     Floating chat bubble + chat window (stays below the site navbar)
================================================================ --}}

<div id="gmetChatbot">
  {{-- Floating toggle button --}}
  <button id="chatbotToggle" class="chatbot-toggle" aria-label="Open Chat" title="Chat with GMET">
    <span class="chatbot-toggle-icon" id="chatbotToggleIcon"><i class="fas fa-comments"></i></span>
    <span class="chatbot-pulse"></span>
  </button>

  {{-- Chat window --}}
  <div id="chatbotWindow" class="chatbot-window" style="display:none;">
    <div class="chatbot-header">
      <div class="chatbot-header-left">
        <img src="{{ asset('assets/images/gmet-logo.png') }}" alt="GMET" class="chatbot-avatar">
        <div>
          <strong>GMET Assistant</strong>
          <small>Online • Ask me anything</small>
        </div>
      </div>
      <div class="chatbot-header-actions">
        <button id="chatbotClear" class="chatbot-header-btn" title="Clear chat"><i class="fas fa-trash-alt"></i></button>
        <button id="chatbotClose" class="chatbot-header-btn" title="Close chat"><i class="fas fa-times"></i></button>
      </div>
    </div>

    <div class="chatbot-body" id="chatbotBody">
      <div class="chat-msg bot">
        <div class="chat-bubble bot-bubble">
          <p>Hello! 👋 I'm the <strong>GMET Assistant</strong>.</p>
          <p>I can help you learn about our services, products, projects, team, and more. Just type a question or tap a suggestion below!</p>
        </div>
      </div>
      <div class="chatbot-chips">
        <button class="chip" data-msg="What does GMET do?">What does GMET do?</button>
        <button class="chip" data-msg="Show me your services">Services</button>
        <button class="chip" data-msg="Show me your products">Products</button>
        <button class="chip" data-msg="Show me your team">Team</button>
        <button class="chip" data-msg="Show me your projects">Projects</button>
        <button class="chip" data-msg="Latest blog posts">Blog</button>
        <button class="chip" data-msg="How can I get started?">Get Started</button>
        <button class="chip" data-msg="Contact information">Contact</button>
      </div>
    </div>

    <div class="chatbot-footer">
      <form id="chatbotForm" autocomplete="off">
        <input type="text" id="chatbotInput" class="chatbot-input" placeholder="Ask about services, products, team..." maxlength="500" autocomplete="off">
        <button type="submit" class="chatbot-send" id="chatbotSend" title="Send"><i class="fas fa-paper-plane"></i></button>
      </form>
    </div>
  </div>
</div>

{{-- ================ STYLES ================ --}}
<style>
  #gmetChatbot {
    --chatbot-top: 90px;
  }

  /* Toggle button */
  .chatbot-toggle {
    position: fixed;
    bottom: 28px;
    right: 28px;
    width: 60px;
    height: 60px;
    border-radius: 50%;
    background: linear-gradient(135deg, #1f5d2b 0%, #123b1d 100%);
    color: #fff;
    border: none;
    cursor: pointer;
    box-shadow: 0 6px 24px rgba(18, 59, 29, .35);
    z-index: 99999;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: transform .25s ease, box-shadow .25s ease;
  }

  .chatbot-toggle:hover {
    transform: scale(1.08);
    box-shadow: 0 8px 30px rgba(18, 59, 29, .5);
  }

  .chatbot-toggle-icon {
    font-size: 1.5rem;
  }

  .chatbot-pulse {
    position: absolute;
    width: 100%;
    height: 100%;
    border-radius: 50%;
    background: rgba(31, 93, 43, .3);
    animation: chatPulse 2.5s infinite;
    pointer-events: none;
  }

  @keyframes chatPulse {
    0% {
      transform: scale(1);
      opacity: .6;
    }

    100% {
      transform: scale(1.6);
      opacity: 0;
    }
  }

  /* Chat window: height is capped so it never overlaps the navbar */
  .chatbot-window {
    position: fixed;
    bottom: 100px;
    right: 28px;
    width: 400px;
    max-width: calc(100vw - 32px);
    height: 560px;
    max-height: calc(100vh - 100px - var(--chatbot-top) - 12px);
    border-radius: 20px;
    background: #fff;
    box-shadow: 0 12px 48px rgba(0, 0, 0, .18);
    z-index: 99998;
    display: flex;
    flex-direction: column;
    overflow: hidden;
    animation: chatSlideUp .3s ease;
  }

  @keyframes chatSlideUp {
    from {
      opacity: 0;
      transform: translateY(20px);
    }

    to {
      opacity: 1;
      transform: translateY(0);
    }
  }

  /* Header */
  .chatbot-header {
    background: linear-gradient(135deg, #1f5d2b 0%, #123b1d 100%);
    color: #fff;
    padding: 14px 18px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 10px;
    flex-shrink: 0;
  }

  .chatbot-header-left {
    display: flex;
    align-items: center;
    gap: 10px;
  }

  .chatbot-avatar {
    width: 38px;
    height: 38px;
    border-radius: 50%;
    object-fit: cover;
    border: 2px solid rgba(255, 255, 255, .3);
  }

  .chatbot-header-left strong {
    display: block;
    font-size: .95rem;
  }

  .chatbot-header-left small {
    font-size: .75rem;
    opacity: .85;
  }

  .chatbot-header-actions {
    display: flex;
    gap: 6px;
  }

  .chatbot-header-btn {
    background: rgba(255, 255, 255, .15);
    border: none;
    color: #fff;
    width: 32px;
    height: 32px;
    border-radius: 50%;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: .8rem;
    transition: background .2s ease;
  }

  .chatbot-header-btn:hover {
    background: rgba(255, 255, 255, .3);
  }

  /* Body */
  .chatbot-body {
    flex: 1;
    overflow-y: auto;
    padding: 16px 14px;
    display: flex;
    flex-direction: column;
    gap: 10px;
    background: #f5f8f5;
  }

  .chatbot-body::-webkit-scrollbar {
    width: 5px;
  }

  .chatbot-body::-webkit-scrollbar-thumb {
    background: #c8d8c4;
    border-radius: 6px;
  }

  /* Bubbles */
  .chat-msg {
    display: flex;
    max-width: 88%;
  }

  .chat-msg.bot {
    align-self: flex-start;
  }

  .chat-msg.user {
    align-self: flex-end;
  }

  .chat-bubble {
    padding: 10px 14px;
    border-radius: 16px;
    font-size: .88rem;
    line-height: 1.55;
    word-wrap: break-word;
    overflow-wrap: break-word;
  }

  .bot-bubble {
    background: #fff;
    color: #1a3d1f;
    border: 1px solid #e2ece0;
    border-top-left-radius: 4px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, .04);
  }

  .user-bubble {
    background: linear-gradient(135deg, #1f5d2b, #267a36);
    color: #fff;
    border-top-right-radius: 4px;
  }

  .chat-bubble p {
    margin: 0 0 6px;
  }

  .chat-bubble p:last-child {
    margin-bottom: 0;
  }

  .chat-bubble strong {
    color: inherit;
  }

  .chat-bubble a {
    color: #1f5d2b;
    text-decoration: underline;
    font-weight: 600;
  }

  .user-bubble a {
    color: #b6f0c2;
  }

  .chat-bubble ul,
  .chat-bubble ol {
    margin: 4px 0;
    padding-left: 18px;
  }

  .chat-bubble li {
    margin-bottom: 2px;
  }

  /* Typing indicator */
  .typing-indicator {
    display: flex;
    gap: 4px;
    padding: 12px 16px;
    background: #fff;
    border: 1px solid #e2ece0;
    border-radius: 16px;
    border-top-left-radius: 4px;
    width: fit-content;
  }

  .typing-dot {
    width: 8px;
    height: 8px;
    background: #a0c4a4;
    border-radius: 50%;
    animation: typingBounce .6s infinite alternate;
  }

  .typing-dot:nth-child(2) {
    animation-delay: .15s;
  }

  .typing-dot:nth-child(3) {
    animation-delay: .3s;
  }

  @keyframes typingBounce {
    to {
      background: #1f5d2b;
      transform: translateY(-4px);
    }
  }

  /* Chips */
  .chatbot-chips {
    display: flex;
    flex-wrap: wrap;
    gap: 6px;
    padding: 4px 0;
  }

  .chip {
    background: #eaf3ea;
    color: #1f5d2b;
    border: 1px solid #c5dfc4;
    border-radius: 20px;
    padding: 5px 14px;
    font-size: .78rem;
    font-weight: 600;
    cursor: pointer;
    transition: all .2s ease;
    white-space: nowrap;
  }

  .chip:hover {
    background: #1f5d2b;
    color: #fff;
    border-color: #1f5d2b;
  }

  /* Footer */
  .chatbot-footer {
    padding: 10px 12px;
    background: #fff;
    border-top: 1px solid #eef3ed;
    flex-shrink: 0;
  }

  .chatbot-footer form {
    display: flex;
    gap: 8px;
    align-items: center;
  }

  .chatbot-input {
    flex: 1;
    border: 1px solid #d4e2d2;
    border-radius: 24px;
    padding: 10px 16px;
    font-size: .88rem;
    outline: none;
    transition: border-color .2s ease;
    background: #f9fbf9;
  }

  .chatbot-input:focus {
    border-color: #1f5d2b;
    background: #fff;
  }

  .chatbot-send {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    background: #1f5d2b;
    color: #fff;
    border: none;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: .9rem;
    transition: background .2s ease, transform .15s ease;
    flex-shrink: 0;
  }

  .chatbot-send:hover {
    background: #123b1d;
    transform: scale(1.05);
  }

  .chatbot-send:disabled {
    opacity: .5;
    cursor: not-allowed;
  }

  /* Mobile: fill the screen below the navbar */
  @media (max-width: 480px) {
    .chatbot-window {
      top: var(--chatbot-top);
      bottom: 0;
      right: 0;
      width: 100vw;
      height: auto;
      max-height: none;
      border-radius: 16px 16px 0 0;
    }

    .chatbot-toggle {
      bottom: 18px;
      right: 18px;
    }
  }
</style>

{{-- ================ SCRIPT ================ --}}
<script>
  document.addEventListener('DOMContentLoaded', function() {
    const root = document.getElementById('gmetChatbot');
    const toggle = document.getElementById('chatbotToggle');
    const win = document.getElementById('chatbotWindow');
    const closeBtn = document.getElementById('chatbotClose');
    const clearBtn = document.getElementById('chatbotClear');
    const form = document.getElementById('chatbotForm');
    const input = document.getElementById('chatbotInput');
    const body = document.getElementById('chatbotBody');
    const sendBtn = document.getElementById('chatbotSend');
    const toggleIcon = document.getElementById('chatbotToggleIcon');
    let isOpen = false;

    const CHIPS_FULL = [
      ['What does GMET do?', 'What does GMET do?'],
      ['Services', 'Show me your services'],
      ['Products', 'Show me your products'],
      ['Team', 'Show me your team'],
      ['Projects', 'Show me your projects'],
      ['Blog', 'Latest blog posts'],
      ['Get Started', 'How can I get started?'],
      ['Contact', 'Contact information'],
    ];
    const CHIPS_FOLLOWUP = CHIPS_FULL.slice(1, 6).concat([CHIPS_FULL[7]]);

    const chipsHtml = list => list.map(([label, msg]) =>
      `<button class="chip" data-msg="${msg}">${label}</button>`).join('');

    /* Keep the chat window below the site navbar */
    function updateChatOffset() {
      // Ignore page hero banners (.page-head) and anything inside the chatbot itself
      const nav = [...document.querySelectorAll('.navbar, nav, header')]
        .find(el => !el.closest('#gmetChatbot') && !el.classList.contains('page-head') &&
          !el.closest('.page-head'));
      let bottom = nav ? Math.max(0, nav.getBoundingClientRect().bottom) : 0;
      // Safety cap: never reserve more than 30% of the screen height
      bottom = Math.min(bottom, window.innerHeight * 0.3);
      root.style.setProperty('--chatbot-top', Math.max(bottom, 12) + 'px');
    }
    updateChatOffset();
    window.addEventListener('resize', updateChatOffset);
    window.addEventListener('scroll', updateChatOffset, {
      passive: true
    });

    function setOpen(open) {
      isOpen = open;
      win.style.display = open ? 'flex' : 'none';
      toggleIcon.innerHTML = open ? '<i class="fas fa-times"></i>' : '<i class="fas fa-comments"></i>';
      if (open) {
        updateChatOffset();
        input.focus();
        scrollToBottom();
      }
    }
    toggle.addEventListener('click', () => setOpen(!isOpen));
    closeBtn.addEventListener('click', () => setOpen(false));

    /* Clear chat */
    clearBtn.addEventListener('click', () => {
      body.innerHTML = `
      <div class="chat-msg bot">
        <div class="chat-bubble bot-bubble">
          <p>Chat cleared! 🧹</p>
          <p>How can I help you? Ask me about GMET's services, products, team, projects, or anything else!</p>
        </div>
      </div>
      <div class="chatbot-chips">${chipsHtml(CHIPS_FULL)}</div>`;
    });

    /* Form submit */
    form.addEventListener('submit', e => {
      e.preventDefault();
      const msg = input.value.trim();
      if (!msg) return;
      input.value = '';
      sendMessage(msg);
    });

    /* Chip clicks: one delegated listener, works for every chip set */
    body.addEventListener('click', e => {
      const chip = e.target.closest('.chip');
      if (chip && !sendBtn.disabled) sendMessage(chip.dataset.msg);
    });

    /* Send message to server */
    async function sendMessage(text) {
      appendMessage(text, 'user');
      body.querySelectorAll('.chatbot-chips').forEach(c => c.remove());
      const typing = showTyping();
      input.disabled = true;
      sendBtn.disabled = true;

      try {
        const res = await fetch('{{ route("chatbot.handle") }}', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Accept': 'application/json',
          },
          body: JSON.stringify({
            message: text
          }),
        });
        const data = await res.json();
        removeTyping(typing);
        if (data.reply) appendMessage(data.reply, 'bot');
        showFollowUpChips();
      } catch (err) {
        removeTyping(typing);
        appendMessage("I'm sorry, I couldn't process your request right now. Please try again or [contact us directly](/contact). 😊", 'bot');
      }

      input.disabled = false;
      sendBtn.disabled = false;
      input.focus();
    }

    function appendMessage(text, sender) {
      const div = document.createElement('div');
      div.className = `chat-msg ${sender}`;
      div.innerHTML = `<div class="chat-bubble ${sender}-bubble">${formatMarkdown(text)}</div>`;
      body.appendChild(div);
      scrollToBottom();
    }

    /* Minimal markdown → HTML */
    function formatMarkdown(text) {
      return text
        .replace(/\*\*(.+?)\*\*/g, '<strong>$1</strong>')
        .replace(/\*(.+?)\*/g, '<em>$1</em>')
        .replace(/_(.+?)_/g, '<em>$1</em>')
        .replace(/\[([^\]]+)\]\(([^)]+)\)/g, '<a href="$2" target="_blank" rel="noopener">$1</a>')
        .replace(/^• (.+)$/gm, '<li>$1</li>')
        .replace(/(<li>.*<\/li>\n?)+/g, m => '<ul>' + m.replace(/\n/g, '') + '</ul>')
        .replace(/\n/g, '<br>');
    }

    function showTyping() {
      const div = document.createElement('div');
      div.className = 'chat-msg bot typing-msg';
      div.innerHTML = '<div class="typing-indicator"><span class="typing-dot"></span><span class="typing-dot"></span><span class="typing-dot"></span></div>';
      body.appendChild(div);
      scrollToBottom();
      return div;
    }

    function removeTyping(el) {
      if (el && el.parentNode) el.parentNode.removeChild(el);
    }

    function showFollowUpChips() {
      body.querySelectorAll('.chatbot-chips').forEach(c => c.remove());
      const div = document.createElement('div');
      div.className = 'chatbot-chips';
      div.innerHTML = chipsHtml(CHIPS_FOLLOWUP);
      body.appendChild(div);
      scrollToBottom();
    }

    function scrollToBottom() {
      setTimeout(() => {
        body.scrollTop = body.scrollHeight;
      }, 50);
    }
  });
</script>