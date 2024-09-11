<?php

// @formatter:off
// phpcs:ignoreFile
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $notulen_id
 * @property string $name
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Notulen $notulen
 * @method static \Illuminate\Database\Eloquent\Builder|Guest newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Guest newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Guest query()
 * @method static \Illuminate\Database\Eloquent\Builder|Guest whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Guest whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Guest whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Guest whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Guest whereNotulenId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Guest whereUpdatedAt($value)
 */
	class Guest extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $user_id
 * @property int|null $notulen_id
 * @property string $notification_topic
 * @property string $notification_message
 * @property int $read_status
 * @property string|null $read_time
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|Notification newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Notification newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Notification query()
 * @method static \Illuminate\Database\Eloquent\Builder|Notification whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Notification whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Notification whereNotificationMessage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Notification whereNotificationTopic($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Notification whereNotulenId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Notification whereReadStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Notification whereReadTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Notification whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Notification whereUserId($value)
 */
	class Notification extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $meeting_title
 * @property string $department
 * @property string $meeting_date
 * @property string $meeting_time
 * @property string $meeting_location
 * @property string $agenda
 * @property string $discussion
 * @property string $decisions
 * @property int $scripter_id
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Guest> $guests
 * @property-read int|null $guests_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\User> $participants
 * @property-read int|null $participants_count
 * @property-read \App\Models\User $scripter
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\NotulenTask> $tasks
 * @property-read int|null $tasks_count
 * @method static \Illuminate\Database\Eloquent\Builder|Notulen newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Notulen newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Notulen query()
 * @method static \Illuminate\Database\Eloquent\Builder|Notulen whereAgenda($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Notulen whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Notulen whereDecisions($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Notulen whereDepartment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Notulen whereDiscussion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Notulen whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Notulen whereMeetingDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Notulen whereMeetingLocation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Notulen whereMeetingTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Notulen whereMeetingTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Notulen whereScripterId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Notulen whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Notulen whereUpdatedAt($value)
 */
	class Notulen extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $notulen_id
 * @property string $task_topic
 * @property array $task_pic
 * @property array|null $guest_pic
 * @property string $task_due_date
 * @property string $status
 * @property string $completion
 * @property string|null $description
 * @property string|null $attachment
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\TaskLog> $logs
 * @property-read int|null $logs_count
 * @property-read \App\Models\Notulen $notulen
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|NotulenTask newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|NotulenTask newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|NotulenTask query()
 * @method static \Illuminate\Database\Eloquent\Builder|NotulenTask whereAttachment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NotulenTask whereCompletion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NotulenTask whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NotulenTask whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NotulenTask whereGuestPic($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NotulenTask whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NotulenTask whereNotulenId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NotulenTask whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NotulenTask whereTaskDueDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NotulenTask whereTaskPic($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NotulenTask whereTaskTopic($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NotulenTask whereUpdatedAt($value)
 */
	class NotulenTask extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $task_id
 * @property string $update_description
 * @property int $updated_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\NotulenTask $task
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|TaskLog newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TaskLog newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TaskLog query()
 * @method static \Illuminate\Database\Eloquent\Builder|TaskLog whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TaskLog whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TaskLog whereTaskId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TaskLog whereUpdateDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TaskLog whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TaskLog whereUpdatedBy($value)
 */
	class TaskLog extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string $phone
 * @property string $usertype
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @method static \Database\Factories\UserFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUsertype($value)
 */
	class User extends \Eloquent {}
}

