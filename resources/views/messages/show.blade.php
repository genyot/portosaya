<x-app-layout>

    <x-admin-form-style />

    {{-- HEADER --}}
    <div class="crud-form-header">
        <div>
            <a href="{{ route('messages.index') }}" class="crud-back-link">
                <i class="bi bi-arrow-left"></i>
                <span>Kembali ke Pesan Masuk</span>
            </a>

            <h1 class="crud-form-title">Detail Pesan</h1>
            <p class="crud-form-subtitle">
                Pesan dari pengunjung melalui form kontak.
            </p>
        </div>
    </div>


    <div class="crud-form-wrapper" style="max-width: 760px;">

        {{-- KARTU PESAN --}}
        <div class="crud-form-card">

            {{-- HEADER PESAN --}}
            <div class="msg-head">

                <div class="msg-avatar">
                    {{ strtoupper(substr($message->name, 0, 1)) }}
                </div>

                <div class="msg-head-info">
                    <h2>{{ $message->name }}</h2>
                    <a href="mailto:{{ $message->email }}" class="msg-email">
                        <i class="bi bi-envelope"></i>
                        {{ $message->email }}
                    </a>
                </div>

                <div class="msg-date">
                    <i class="bi bi-clock"></i>
                    {{ $message->created_at->format('d M Y, H:i') }}
                </div>

            </div>


            {{-- SUBJEK --}}
            <div class="msg-subject">
                <span class="msg-subject-label">Subjek</span>
                <span class="msg-subject-value">
                    {{ $message->subject ?: '(Tanpa subjek)' }}
                </span>
            </div>


            {{-- ISI PESAN --}}
            <div class="msg-body">
                {!! nl2br(e($message->message)) !!}
            </div>


            {{-- ACTION --}}
            <div class="msg-actions">

                <a href="mailto:{{ $message->email }}" class="crud-save">
                    <i class="bi bi-reply"></i>
                    <span>Balas via Email</span>
                </a>

                <button
                    type="button"
                    class="msg-delete-btn"
                    onclick="openDeleteModal(
                        '{{ $message->id }}',
                        @js($message->name)
                    )"
                >
                    <i class="bi bi-trash3"></i>
                    <span>Hapus Pesan</span>
                </button>

            </div>

        </div>

    </div>


    {{-- MODAL HAPUS --}}
    <x-delete-modal
        title="Hapus Pesan?"
        label="pesan dari"
        url-prefix="/messages"
    />


    <style>
        .msg-head {
            display: flex;
            align-items: center;
            gap: 15px;

            padding-bottom: 22px;
            margin-bottom: 24px;

            border-bottom: 1px solid var(--border);
        }

        .msg-avatar {
            width: 52px;
            height: 52px;

            flex-shrink: 0;

            display: flex;
            align-items: center;
            justify-content: center;

            border-radius: 50%;

            background: var(--purple);
            color: #fff;

            font-size: 20px;
            font-weight: 700;
        }

        .msg-head-info {
            min-width: 0;
            flex: 1;
        }

        .msg-head-info h2 {
            margin: 0 0 5px;

            color: var(--text-primary);
            font-size: 17px;
            font-weight: 700;
        }

        .msg-email {
            display: inline-flex;
            align-items: center;
            gap: 6px;

            color: var(--text-muted);
            font-size: 12px;

            transition: .2s ease;
        }

        .msg-email:hover { color: var(--purple-light); }

        .msg-date {
            display: inline-flex;
            align-items: center;
            gap: 6px;

            color: var(--text-dim);
            font-size: 11px;

            white-space: nowrap;
        }

        .msg-subject {
            display: flex;
            flex-direction: column;
            gap: 5px;

            margin-bottom: 20px;
        }

        .msg-subject-label {
            color: var(--text-dim);
            font-size: 10px;
            font-weight: 600;

            text-transform: uppercase;
            letter-spacing: .5px;
        }

        .msg-subject-value {
            color: var(--text-primary);
            font-size: 15px;
            font-weight: 600;
        }

        .msg-body {
            padding: 18px 20px;

            background: var(--bg-alt);
            border: 1px solid var(--border);
            border-radius: 10px;

            color: var(--text-secondary);
            font-size: 13.5px;
            line-height: 1.9;

            white-space: pre-wrap;
            word-break: break-word;
        }

        .msg-actions {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            gap: 10px;

            margin-top: 26px;
            padding-top: 22px;

            border-top: 1px solid var(--border);
        }

        .msg-delete-btn {
            height: 40px;

            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 7px;

            padding: 0 17px;

            background: rgba(233, 75, 98, .1);
            color: var(--red);

            border: 1px solid rgba(233, 75, 98, .2);
            border-radius: 7px;

            font-family: 'Inter', sans-serif;
            font-size: 11px;
            font-weight: 600;

            cursor: pointer;

            transition: .2s ease;
        }

        .msg-delete-btn:hover {
            background: rgba(233, 75, 98, .2);
            transform: translateY(-1px);
        }

        @media (max-width: 576px) {
            .msg-head {
                flex-wrap: wrap;
            }

            .msg-date {
                width: 100%;
                margin-top: 4px;
            }

            .msg-actions {
                flex-direction: column-reverse;
                align-items: stretch;
            }

            .msg-actions a,
            .msg-actions button {
                width: 100%;
            }
        }
    </style>

</x-app-layout>
