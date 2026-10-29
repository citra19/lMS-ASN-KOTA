<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\Question;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class QuestionController extends Controller
{
    /**
     * Display a listing of questions for the specified activity.
     */
    public function index(Activity $activity, Request $request): View
    {
        $typeFilter = $request->query('type');

        $query = $activity->questions()->orderBy('order', 'asc');

        if ($typeFilter && in_array($typeFilter, ['pretest', 'posttest', 'both'])) {
            $query->where('type', $typeFilter);
        }

        $questions = $query->get();

        $stats = [
            'total' => $activity->questions()->count(),
            'both' => $activity->questions()->where('type', 'both')->count(),
            'pretest' => $activity->questions()->where('type', 'pretest')->count(),
            'posttest' => $activity->questions()->where('type', 'posttest')->count(),
        ];

        return view('admin.questions.index', compact('activity', 'questions', 'stats', 'typeFilter'));
    }

    /**
     * Show the form for creating a new question.
     */
    public function create(Activity $activity): View
    {
        $nextOrder = ($activity->questions()->max('order') ?? 0) + 1;

        return view('admin.questions.create', compact('activity', 'nextOrder'));
    }

    /**
     * Store a newly created question in storage.
     */
    public function store(Request $request, Activity $activity): RedirectResponse
    {
        $validated = $request->validate([
            'type' => ['required', 'in:pretest,posttest,both'],
            'question_text' => ['required', 'string'],
            'options' => ['required', 'array', 'min:2'],
            'options.A' => ['required', 'string'],
            'options.B' => ['required', 'string'],
            'options.C' => ['nullable', 'string'],
            'options.D' => ['nullable', 'string'],
            'options.E' => ['nullable', 'string'],
            'correct_answer' => ['required', 'string', 'max:10'],
            'explanation' => ['nullable', 'string'],
            'order' => ['nullable', 'integer', 'min:1'],
        ]);

        // Clean options by removing null/empty strings
        $cleanedOptions = array_filter(
            $request->input('options', []),
            fn ($value) => ! is_null($value) && trim((string) $value) !== ''
        );

        if (! array_key_exists($validated['correct_answer'], $cleanedOptions)) {
            return back()->withInput()->withErrors([
                'correct_answer' => 'Kunci jawaban yang dipilih harus memiliki teks opsi jawaban.',
            ]);
        }

        $order = $validated['order'] ?? (($activity->questions()->max('order') ?? 0) + 1);

        $activity->questions()->create([
            'type' => $validated['type'],
            'question_text' => $validated['question_text'],
            'options' => $cleanedOptions,
            'correct_answer' => strtoupper(trim($validated['correct_answer'])),
            'explanation' => $validated['explanation'] ?? null,
            'order' => $order,
        ]);

        return redirect()->route('admin.questions.index', $activity->id)
            ->with('success', 'Butir soal baru berhasil ditambahkan ke Bank Soal.');
    }

    /**
     * Show the form for editing the specified question.
     */
    public function edit(Activity $activity, Question $question): View
    {
        abort_if($question->activity_id !== $activity->id, 404);

        return view('admin.questions.edit', compact('activity', 'question'));
    }

    /**
     * Update the specified question in storage.
     */
    public function update(Request $request, Activity $activity, Question $question): RedirectResponse
    {
        abort_if($question->activity_id !== $activity->id, 404);

        $validated = $request->validate([
            'type' => ['required', 'in:pretest,posttest,both'],
            'question_text' => ['required', 'string'],
            'options' => ['required', 'array', 'min:2'],
            'options.A' => ['required', 'string'],
            'options.B' => ['required', 'string'],
            'options.C' => ['nullable', 'string'],
            'options.D' => ['nullable', 'string'],
            'options.E' => ['nullable', 'string'],
            'correct_answer' => ['required', 'string', 'max:10'],
            'explanation' => ['nullable', 'string'],
            'order' => ['nullable', 'integer', 'min:1'],
        ]);

        $cleanedOptions = array_filter(
            $request->input('options', []),
            fn ($value) => ! is_null($value) && trim((string) $value) !== ''
        );

        if (! array_key_exists($validated['correct_answer'], $cleanedOptions)) {
            return back()->withInput()->withErrors([
                'correct_answer' => 'Kunci jawaban yang dipilih harus memiliki teks opsi jawaban.',
            ]);
        }

        $question->update([
            'type' => $validated['type'],
            'question_text' => $validated['question_text'],
            'options' => $cleanedOptions,
            'correct_answer' => strtoupper(trim($validated['correct_answer'])),
            'explanation' => $validated['explanation'] ?? null,
            'order' => $validated['order'] ?? $question->order,
        ]);

        return redirect()->route('admin.questions.index', $activity->id)
            ->with('success', 'Soal nomor #'.$question->order.' berhasil diperbarui.');
    }

    /**
     * Remove the specified question from storage.
     */
    public function destroy(Activity $activity, Question $question): RedirectResponse
    {
        abort_if($question->activity_id !== $activity->id, 404);

        $order = $question->order;
        $question->delete();

        return redirect()->route('admin.questions.index', $activity->id)
            ->with('success', 'Soal nomor #'.$order.' berhasil dihapus dari Bank Soal.');
    }

    /**
     * Duplicate a question for fast creation.
     */
    public function duplicate(Activity $activity, Question $question): RedirectResponse
    {
        abort_if($question->activity_id !== $activity->id, 404);

        $newOrder = ($activity->questions()->max('order') ?? 0) + 1;
        $newQuestion = $question->replicate();
        $newQuestion->order = $newOrder;
        $newQuestion->question_text = $question->question_text.' (Salinan)';
        $newQuestion->save();

        return redirect()->route('admin.questions.index', $activity->id)
            ->with('success', 'Soal berhasil diduplikasi menjadi nomor #'.$newOrder.'.');
    }
}
