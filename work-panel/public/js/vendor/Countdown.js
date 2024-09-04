/**
 * Class that implements a countdown counter and injects value on given container
 *
 * Constructor arguments:
 *   - target: an DOM element where counter value will be injected
 *   - options: see list below
 *
 * Options available:
 *   - start (int): starting second of the countdown
 *   - end (int): ending second of the countdown
 *   - step (int): max number of milliseconds to next time counter changes
 *   - decimals (int): number of decimals
 *   - onComplete (handle): function to call when counter reaches end
 *   - onStep (handle): function to call on every step
 *
 * http://www.tatai.es
 *
 * @author Fran Naranjo
 * @date 2009-09
 */
var Countdown = new Class({
	Implements : [Options, Events],

	target : null,
	start : null,
	stopNow : false,
	last : null,
	
	options : {
		'start' : 10,
		'end' : 0,
		'step' : 100, 	// Milliseconds
		'decimals' : 2,
		'onComplete' : $empty,
		'onStep' : $empty
	},

	initialize : function(target, options) {
		this.target = target;
		this.setOptions(options);	
	},

	/**
	 * Starts countdown
	 *
	 * @public
	 */
	start : function() {
		this.init = new Date().getTime();
		this._doWork();
	},

	/**
	 * Do work on step
	 *
	 * @protected
	 */
	_doWork : function() {
		var now = new Date().getTime();
		var show = this.options.start - ((now - this.init) / 1000);
		
		this.last = show;
		
		if(show <= this.options.end) {
			this.last = this.options.end;

			this.target.set('text', this.options.end.toFixed(this.options.decimals));
			this.fireEvent('complete');
		}
		else {
			this.target.set('text', show.toFixed(this.options.decimals));

			this.fireEvent('step', [this.target, show]);

			if(!this.stopNow) {
				this._doWork.delay(Math.random() * this.options.step, this);
			}
		}
	},
	
	/**
	 * Stops countdown on next step
	 *
	 * @public
	 */
	stop : function() {
		this.stopNow = true;
	},

	/**
	 * Returns time on last step of the countdown
	 *
	 * @public
	 */
	getLast : function() {
		return this.last;
	}
});